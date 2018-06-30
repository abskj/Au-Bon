<?php

namespace App\Http\Controllers;

use App\customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class custController extends Controller
{
    //
    public function create(Request $request){
       $this->validate($request,[
            'mobile'=>'required',
           'name'=>'required',
            'address'=>'required',
        ]);
       try{
           $cust=new customer([
               'name' => $request->input('name'),
               'mobile' => $request->input('mobile'),
               'address' => $request->input('address'),
           ]);
           $cust->save();
       }catch (\Throwable $e){
           return response()->json([
               'code'=>4,
               'message'=>'customer could not be created',
           ],400);
       }
       return response()->json([
           'code'=>1,
           'message'=>'customer created successfully',
       ]);
    }
}
