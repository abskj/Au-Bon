<?php

namespace App\Http\Controllers;

use App\bill_transaction;
use App\customer;
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
                ]);
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
            ]);
        }
    }

    public function partTransaction(Request $request){

}

    public function initiateTransaction(Request $request){
       $this->validate($request,[
            'cust_id' => 'required',
            'user_name' => 'required',
            'branch_id' => 'required',
        ]);
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
            'date_time'=>'20'.date('y-m-d h:i:s'),
            'branch_id'=>$request->input('branch_id'),
            'user_name'=>$request->input('user_name'),
            'discount'=>0,
            'net_billed'=>0,
        ]);
        $tran->save();
        return response()->json([
            'code'=>1,
            'message'=>'Transaction initiated',
            'id'=>$id,
        ]);
    }


}
