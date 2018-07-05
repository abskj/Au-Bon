<?php

namespace App\Http\Controllers;

use App\bill_transaction;
use App\Branch;
use App\customer;
use App\foodItem;
use App\Restro;
use App\settlement;
use App\tran_detail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class billController extends Controller
{
    //
    public function customer(Request $request){
        $this->validate($request,[
            'mobile' => 'required'
        ]);
        try{
            $customer=customer::where('mobile',$request->input('mobile'))->get()->first();
            if ($customer === null){
                return response()->json([
                    'code'=> 5,
                    'message' => 'customer not found'
                ],401);
            }
            else{
                return response()->json([
                    'code'=> 1,
                    'customer_name' => $customer->name,
                    'customer_id' => $customer->id,
                    'customer_mobile'=>$customer->mobile,
                    'customer_addr'=>$customer->address,
                ]);
            }

        }
        catch (\Throwable $e){
            return response()->json([
                'code'=> 4,
                'message' => 'some unknown error occures'
            ],501);
        }
    }

    public function partTransaction(Request $request){
        $this->validate($request,[
            'tran_id' => 'required',

            'item_id' => 'required',
            'qty' => 'required',

            'branch_id' => 'required',
        ]);
        $iid=$request->input('item_id');
        $item=foodItem::where(['item_id'=>$iid])->first();
        $cat=$item->cat_id;

        $rate=$item->item_rate;
        $qty=$request->input('qty');
        $total=$rate*$qty;
        $tran=new tran_detail([
            'item_name' => $item->item_name,
            'tran_id' => $request->input('tran_id'),
            'cat_id' => $cat,
            'item_id' => $request->input('item_id'),
            'qty' => $request->input('qty'),
            'rate' => $rate,
            'total' => $total,
            'branch_id' => $request->input('branch_id'),

        ]);

        $tran->save();
        return response()->json([
            'code'=>1,
            'message'=>'bill updated'
        ]);

}

    public function initiateTransaction(Request $request){
       $this->validate($request,[
            'cust_id' => 'required',
            'user_name' => 'required',
            'branch_id' => 'required',
           'steward_id' => 'required',
           'table_no' =>'required',

        ]);
       $restro=Restro::find((Branch::find($request->input('branch_id'))->restro_id));



        $id=null;
        while (true){
            $y=mt_rand(0,999);
            $x=date('ymdhi');
            $nu_id=$x.$y;
            $x=tran_detail::where('tran_id',$nu_id)->count();

            if($x==0){
                $id=$nu_id;
                break;}
        }
        $tran=new bill_transaction([
            'tran_id'=> $id,
            'cust_id'=>$request->input('cust_id'),
            'bill_amount'=>0,
            'branch_id'=>$request->input('branch_id'),
            'user_name'=>$request->input('user_name'),
            'steward_id'=>$request->input('steward_id'),
            'table_no'=>$request->input('table_no'),
            'discount'=>0,
            'net_billed'=>0,
            'gst_comp' => $restro->gst_comp,
        ]);
        $tran->save();
        return response()->json([
            'code'=>1,
            'message'=>'Transaction initiated',
            'id'=>$id,
            'gst_comp'=>$restro->gst_comp,
        ]);
    }

    public function getTransaction(Request $request)
    {
        $this->validate($request, [
            'transaction_id' => 'required'
        ]);
        $transactions= tran_detail::where('tran_id', $request->input('transaction_id'))->get();
        $bill=bill_transaction::where('tran_id',$request->input('transaction_id'))->get()->first();

        return response()->json([
            'transactions' => $transactions,
            'bill' => $bill,
            'code' => 1,
        ],201);
    }

    public function removeItem(Request $request){
        $this->validate($request,[
            'tran_id' => 'required'
        ]);
        try{
            $tran=tran_detail::find($request->input('tran_id'));
            $tran->delete();
            return response()->json([
                'code' => 1,
                'message' => 'item removed from list'
            ],201);
        }
            catch(Throwable $e){
                return response()->json([
                    'code' => 3,
                    'message' => 'item not found'
                ],404);
            }
    }
    public function reset(Request $request){
        $this->validate($request,[
            'tran_id' => 'required'
        ]);
        try{
            $transactions = tran_detail::where('tran_id', $request->input('tran_id'))->get();
            foreach ($transactions as $tran){
                $tran->delete();
            }
            return response()->json([
                'code' => 1,
                'message' => 'transactions deleted'
            ]);
        }
        catch(Throwable $e){
            return response()->json([
                'code'=> 4
            ],404);
        }

    }
    public function complete(Request $request){
        $this->validate($request,[
            'transaction_id' => 'required',
            'discount_rate' => 'required',
        ]);
        $total=0.00;
        $transactions =  tran_detail::where('tran_id', $request->input('tran_id'))->get();
        foreach ($transactions as $tran){
            $total+=$tran->total;
        }
        $dr=$request->input('discount_rate');
        $net_total=$total-($dr*$total);
        $bill=bill_transaction::where('tran_id',$request->input('transaction_id'))->first();
        $restro=Restro::find(Branch::find($bill->branch_id))->first();

        $gstFlag=$restro->gst_comp;
        if($gstFlag==1){
            $bill->net_billed=$total;
            $bill->bill_amount=$net_total;

        }
        else{
            $bill->net_billed=$total;
            $bill->bill_amount=($net_total-($net_total*0.18));
        }

        $bill->save();
        return response()->json([
            'code'=>1,
            'message'=>'transaction completed'
        ]);

    }
    public function settle(Request $request){
        $this->validate($request,
            [
                'tran_id' => 'required|unique:settlement',
                'settle_mode' => 'required',

            ]);
        $settlement=null;
        $bill=bill_transaction::where('tran_id',$request->input('transaction_id'))->first();
        if($request->input('settle_mode')==0){
            //assuming 1 for card and 0 for cash
            $settlement=new settlement([
                'tran_id' => $bill->tran_id,
                'customer_id'=> $bill->cust_id,
                'bill_amount' => $bill->bill_amount,
                'settle_mode' => 0,
                'status_flag'=> 0,


            ]);

        }
        else{

                //assuming 1 for card and 0 for cash
                $settlement=new settlement([
                    'tran_id' => $bill->tran_id,
                    'customer_id'=> $bill->cust_id,
                    'bill_amount' => $bill->bill_amount,
                    'settle_mode' => 1,
                    'status_flag'=> 1,
                    'card_number'=> $request->input('card_number'),
                    'bank'=> $request->input('bank'),
                    ]);
        }
        $settlement->save();
        return response()->json([
            'code'=>1
        ]);
    }

}
