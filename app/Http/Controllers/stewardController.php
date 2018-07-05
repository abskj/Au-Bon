<?php

namespace App\Http\Controllers;

use App\steward;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class stewardController extends Controller
{
    //
    public function create(Request $request){
        $this->validate($request,[
            'name' =>'required',
            'branch_id' =>'required',
            'mobile' =>'required',
        ]);
        $steward=new steward([
            'name'=> $request->input('name'),
            'branch_id'=> $request->input('branch_id'),
            'mobile'=> $request->input('mobile'),
        ]);
        $steward->save();
        return response()->json([
            'code'=>1,
            'message' => 'steward created',
        ]);
    }
    public function get(Request $request){
        $this->validate($request,[
            'branch_id'
        ]);
        $stewards= steward::where('branch_id',$request->input('branch_id'))->get();
        return response()->json([
            'code' => 1,
            'data'=> $stewards,
        ],201);
    }
}
