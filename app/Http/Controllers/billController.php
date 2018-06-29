<?php

namespace App\Http\Controllers;

use App\customer;
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
    

}
