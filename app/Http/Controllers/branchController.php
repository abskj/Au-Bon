<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class branchController extends Controller
{
    //
    public function create(Request $request){
        $this->validate($request, [
            'user_name' => 'required',
            'role' => 'required',
            'restro_id' =>'required',
            'address' =>'required',
            'pin' =>'required',
            'phone' =>'required',

        ]);
        if($request->input('role')>=1) {
            return response()->json([
                'error' => 'permission-denied',
                'code' => 2,

            ], 402);
        }
        $branch=new Branch([
            'restro_id' =>$request->input('restro_id'),
            'address' =>$request->input('address'),
            'pin' =>$request->input('pin'),
            'phone' =>$request->input('phone')

        ]);
        $branch->save();
        return response()->json([
            'code'=> 1,
            'message'=>'branch created successfully'
        ]);



    }

    public function get(Request $request){
        $this->validate($request, [
            'user_name' => 'required',
            'role' => 'required',
            'restro_id' =>'required'
            ]);
        if($request->input('role')>=1){
            return response()->json([
                'error'=>'permission-denied',
                'code'=>2,

            ],402);
        }
        $restro_id=$request->input('restro_id');
        $branches=Branch::where('restro_id',$restro_id)->get();
        return response()->json([
           'code' => 1,
            'branch_data' => $branches,
        ]);

    }
    public function del(Request $request){

        $this->validate($request, [
            'user_name' => 'required',
            'role' => 'required',
            'restro_id' =>'required',
            'branch_id' =>'required',
        ]);
        if($request->input('role')>=1){
            return response()->json([
                'error'=>'permission-denied',
                'code'=>2,

            ],401);
        }
        try{
            $branch=Branch::find($request->input('branch_id'));
            $branch->delete();

        }catch (\Throwable $exception){
            return response()->json([
                'code' => 3,
                'message' =>'Branch not found in Database'
            ],404);
        }
        return response()->json([
            'code' => 1,
            'message' => 'deleted'
        ],201);
    }

    public function update(Request $request){
        $this->validate($request, [
            'user_name' => 'required',
            'role' => 'required',
            'restro_id' =>'required'
        ]);
        if($request->input('role')>=1){
            return response()->json([
                'error'=>'permission-denied',
                'code'=>2,

            ],401);
        }
        try{
            $branch=Branch::find($request->input('branch_id'));
            $branch->update('');

        }catch (\Throwable $exception){
            return response()->json([
                'code' => 3,
                'message' =>'Branch not found in Database'
            ],404);
        }
        $
    }
}
