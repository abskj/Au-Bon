<?php

namespace App\Http\Controllers;

use App\bill_transaction;
use App\Branch;
use App\customer;
use App\foodItem;
use App\Restro;
use App\settlement;
use App\steward;
use App\tran_detail;
use App\Bill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Http\Response;
use App\JSON2CSVutil;
use function MongoDB\BSON\toJSON;


class billController extends Controller
{
    //

    public function getData(Request $request)
    {
        $this->validate($request, [
            'to_date' => 'required',
            'from_date' => 'required',
            'user_name' => 'required',
            'branch_id' => 'required',
        ]);
        $from = date($request->input('from_date'));
        $to = date($request->input('to_date'));
        try {
            $trans = bill_transaction::whereBetween('created_at', [$from, $to])->get();
            $array = [];
            foreach ($trans as $tran) {
                $x = json_encode($tran, JSON_UNESCAPED_SLASHES, 3);
                array_push($array, $x);
            }
            $y = json_encode($trans, 64, 3);
        } catch (\Throwable $e) {
            return response()->json([
                'data' => $e
            ], 400);
        }

        return response()->json([
            'data' => $y
        ]);


    }

    public function customer(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'required'
        ]);
        try {
            $customer = customer::where('mobile', $request->input('mobile'))->get()->first();
            if ($customer === null) {
                return response()->json([
                    'code' => 5,
                    'message' => 'customer not found'
                ], 401);
            } else {
                return response()->json([
                    'code' => 1,
                    'customer_name' => $customer->name,
                    'customer_id' => $customer->id,
                    'customer_mobile' => $customer->mobile,
                    'customer_addr' => $customer->address,
                ]);
            }

        } catch (\Throwable $e) {
            return response()->json([
                'code' => 4,
                'message' => 'some unknown error occures'
            ], 501);
        }
    }

    public function partTransaction(Request $request)
    {
        $this->validate($request, [
            'tran_id' => 'required',

            'item_id' => 'required',
            'qty' => 'required',

            'branch_id' => 'required',
        ]);
        $iid = $request->input('item_id');
        $item = foodItem::where(['item_id' => $iid])->first();
        $cat = $item->cat_id;
        $tran_count = tran_detail::where(['tran_id' => $request->input('tran_id'), 'item_id' => $request->input('item_id')])->count();
        if ($tran_count > 0) {
            $tranx = tran_detail::where(['tran_id' => $request->input('tran_id'), 'item_id' => $request->input('item_id')])->first();
            $q = $tranx->qty;
            $new_q = $q + $request->input('qty');
            $tranx->qty = $new_q;
            $rate = $tranx->rate;
            $total = $rate * $new_q;
            $tranx->total = $total;

            $tranx->update();
            return response()->json([
                'code' => 1,
                'message' => 'bill updated'
            ]);
        }

        $rate = $item->item_rate;
        $qty = $request->input('qty');
        $total = $rate * $qty;
        $tran = new tran_detail([
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
            'code' => 1,
            'message' => 'bill updated'
        ]);

    }

    public function initiateTransaction(Request $request)
    {
        $this->validate($request, [
            'cust_id' => 'required',
            'user_name' => 'required',
            'branch_id' => 'required',
            'steward_id' => 'required',
            'table_no' => 'required',

        ]);
        $restro = Restro::find((Branch::find($request->input('branch_id'))->restro_id));


        $id = null;
        while (true) {
            $y = mt_rand(100, 999);
            $x = date('ymdhi');
            $nu_id = $x . $y;
            $x = tran_detail::where('tran_id', $nu_id)->count();

            if ($x == 0) {
                $id = $nu_id;
                break;
            }
        }
        $tran = new bill_transaction([
            'tran_id' => $id,
            'cust_id' => $request->input('cust_id'),
            'bill_amount' => 0,
            'branch_id' => $request->input('branch_id'),
            'user_name' => $request->input('user_name'),
            'steward_id' => $request->input('steward_id'),
            'table_no' => $request->input('table_no'),
            'discount' => 0,
            'net_billed' => 0,
            'gst_comp' => $restro->gst_comp,
        ]);
        $tran->save();
        return response()->json([
            'code' => 1,
            'message' => 'Transaction initiated',
            'id' => $id,
            'gst_comp' => $restro->gst_comp,
        ]);
    }

    public function getTransaction(Request $request)
    {
        $this->validate($request, [
            'transaction_id' => 'required'
        ]);
        $transactions = tran_detail::where('tran_id', $request->input('transaction_id'))->get();
        $bill = bill_transaction::where('tran_id', $request->input('transaction_id'))->get()->first();

        return response()->json([
            'transactions' => $transactions,
            'bill' => $bill,
            'code' => 1,
        ], 201);
    }

    public function removeItem(Request $request)
    {
        $this->validate($request, [
            'tran_id' => 'required'
        ]);
        try {
            $tran = tran_detail::find($request->input('tran_id'));
            $tran->delete();
            return response()->json([
                'code' => 1,
                'message' => 'item removed from list'
            ], 201);
        } catch (Throwable $e) {
            return response()->json([
                'code' => 3,
                'message' => 'item not found'
            ], 404);
        }
    }

    public function reset(Request $request)
    {
        $this->validate($request, [
            'tran_id' => 'required'
        ]);
        try {
            $transactions = tran_detail::where('tran_id', $request->input('tran_id'))->get();
            foreach ($transactions as $tran) {
                $tran->delete();
            }
            return response()->json([
                'code' => 1,
                'message' => 'transactions deleted'
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'code' => 4
            ], 404);
        }

    }

    public function complete(Request $request)
    {
        $this->validate($request, [
            'transaction_id' => 'required',
            'discount_rate' => 'required',
        ]);
        $total = 0.00;
        $transactions = tran_detail::where('tran_id', $request->input('transaction_id'))->get();
        foreach ($transactions as $tran) {
            $total += $tran->total;
        }
        $dr = $request->input('discount_rate');
        $net_total = $total - ($dr * $total);
        $bill = bill_transaction::where('tran_id', $request->input('transaction_id'))->first();
        $restro = Restro::find(Branch::find($bill->branch_id))->first();

        $gstFlag = $restro->gst_comp;
        if ($gstFlag == 1) {
            $bill->net_billed = $total;
            $bill->bill_amount = $net_total;

        } else {
            $bill->net_billed = $total;
            $bill->bill_amount = ($net_total + ($net_total * 0.05));
        }

        $bill->save();
        return response()->json([
            'code' => 1,
            'message' => 'transaction completed'
        ]);

    }

    public function settle(Request $request)
    {
        $this->validate($request,
            [
                'tran_id' => 'required|unique:settlement',
                'settle_mode' => 'required',

            ]);
        $settlement = null;
        $tid = $request->input('tran_id');

        $bill = DB::table('bill_transaction')->where('tran_id', $tid)->first();

        if ($request->input('settle_mode') == 0) {
            //assuming 1 for card and 0 for cash
            $settlement = new settlement([
                'tran_id' => $bill->tran_id,
                'customer_id' => $bill->cust_id,
                'bill_amount' => $bill->bill_amount,
                'settle_mode' => 0,
                'status_flag' => 0,


            ]);

        } else {

            //assuming 1 for card and 0 for cash
            $settlement = new settlement([
                'tran_id' => $bill->tran_id,
                'customer_id' => $bill->cust_id,
                'bill_amount' => $bill->bill_amount,
                'settle_mode' => 1,
                'status_flag' => 1,
                'card_number' => $request->input('card_number'),
                'bank' => $request->input('bank'),
            ]);
        }
        $settlement->save();
        return response()->json([
            'code' => 1,
        ]);
    }
   public function getActiveTrans(Request $request){
       $this->validate($request, [
           'user_name' =>'required',
           'branch_id' => 'required',
       ]);
       $trans=bill_transaction::where('user_name',$request->input('user_name'))
           ->where('branch_id',$request->input('branch_id'))
            ->whereDate('updated_at',date('20y-m-d'))
           ->get();
       $all_transactions=[];
       foreach($trans as $tran){
           $settled=settlement::where('tran_id',$tran->tran_id)->count();
           if($settled>0){
               continue;
           }

           $tranObject=new \stdClass();
           $tranObject->tran_id=$tran->tran_id;
           $tranObject->cust_no=$tran->cust_id;
           $customer=customer::where('mobile',$tran->cust_id)->first();
           $tranObject->addr=$customer->address;
           $tranObject->cust_name=$customer->name;
           $tranObject->steward_id=$tran->steward_id;
           $steward=steward::find($tran->steward_id);
           $tranObject->steward_name=$steward->name;
           $tranObject->discount=$tran->discount;
           $tranObject->table=$tran->table_no;

           array_push($all_transactions,$tranObject);
       }
       return response()->json([
           'code' => 1,
           'activeTransactions' => $all_transactions,
           'date' => date('20y-m-d'),
       ]);
//
   }



    public function printBill(Request $request){
        $this->validate($request, [
            'tran_id' => 'required'
        ]);

        $tranid=$request->input('tran_id');
        $transactions=tran_detail::where('tran_id', $tranid)->get();
        $bill=bill_transaction::where('tran_id',($tranid))->first();
        $branch=branch::find($bill->branch_id);
        $restro=restro::find($branch->restro_id);
        $items=[];
        $rest_info=new \stdClass();
        $rest_info->name=$restro->restro_name;
        $rest_info->no=$restro->phone;
        $headerS=new \stdClass();
        $headerS->header="Celebrate Birthday with Us";
        $headerS->body="We also take party order and provide banquet hall for various party arrangements";


        $cust=customer::where('mobile',$bill->cust_id)->first();
        $cust_info=new \stdClass();
        $cust_info->name=$cust->name;
        $cust_info->mobile=$cust->mobile;
        $cust_info->address=$cust->address;

        $bill_date=$this->dateFormat(substr("($bill->updated_at)",1,10));
        foreach($transactions as $tran){

            $x=new \stdClass();
            $x->name=$tran->item_name;
            $x->rate=$tran->rate;
            $x->total=$tran->total;
            $x->quantity=$tran->qty;
            array_push($items,$x);

        }
        $itemsJSON=json_encode($items);
        $discount=($bill->bill_amount)*($bill->discount);
        $main=json_encode([
            "logo"=> public_path()."/logo.png",
              "phone"=> $branch->phone,
              "gst"=> $restro->gstin,
              "address"=> $branch->address,
              "billNumber" => $tranid,
              "billDate"=> $bill_date,
              "customerDetails"=> $cust_info,
              "restaurantInfo"=> $rest_info,
              "items"=> json_decode($itemsJSON),
              "netAmount"=> $bill->bill_amount,
              "discount"=> $discount,
              "grandTotal"=> $bill->net_billed,
              "additionalInfo"=> $headerS,
        ])  ;

        $printerbill=new Bill(json_decode($main));
        $printerbill->print();
        return response()->json([
            'date' =>substr("($bill->updated_at)",1,10),
            'main' =>$main

        ]);





    }
    public function dateFormat($stringDate){
                           $year=substr($stringDate,0,4);
                           $month=substr($stringDate,5,2);
                           $day=substr($stringDate,8,2);
                           return $day."/".$month."/".$year  ;
    }
}
