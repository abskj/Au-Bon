<?php

namespace App\Http\Controllers;

use App\foodItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class foodItemController extends Controller
{
    //
    public function get(Request $r){
        $this->validate($r,[
            'user_name' => 'required',
            'role' =>'required',
            'branch_id' =>'required',

        ]);
        $items=foodItem::where('branch_id',$r->input('branch_id'))->where('status',1)->get();
        return response()->json([
            'code' => 1,
            'data' => $items,
        ]);
    }

    public function getByCat(Request $r){
        $this->validate($r,[
            'user_name' => 'required',
            'role' =>'required',
            'branch_id' =>'required',
            'cat_id' =>'required',

        ]);
        $items=foodItem::where('branch_id', $r->input('branch_id'))->where('cat_id',$r->input('cat_id'))->get();
        return response()->json([
            'data' => $items
        ]);
    }

    public function create(Request $r){
        $this->validate($r,[
            'user_name' => 'required',
            'role' =>'required',
            'cat_id' => 'required',
            'item_id' => 'required|unique:item_master',
            'branch_id' =>'required',
            'HSN_code'=> 'required',
            'SGST' =>'required',
            'CGST' =>'required',
            'item_name' =>'required',
            'item_rate' =>'required',
        ]);
        if($r->input('role')>2){
            return response()->json([
                'code' => 2,
                'message'=>'unauthorized operation'
            ]);

        }
        $cat=new foodItem([
            'cat_id' => $r->input('cat_id'),
            'user_name' => $r->input('user_name'),
            'item_id' => $r->input('item_id'),
            'branch_id' => $r->input('branch_id'),
            'HSN_code' => $r->input('HSN_code'),
            'SGST' => $r->input('SGST'),
            'CGST' => $r->input('CGST'),
            'item_name' => $r->input('item_name'),
            'item_rate' => $r->input('item_rate'),
            'status' => 1,

        ]);

        try{
            $cat->save();
        }
        catch (\Throwable $e){
            return response()->json([
                'code'=> 4,
                'message' => 'some error occured'
            ]);
        }
        return response()->json([
            'code' => 1,
            'message' => 'item created successfully'
        ]);
    }

    public function update(Request $r){
        $this->validate($r,[
            'user_name' => 'required',
            'role' =>'required',
            'cat_id' => 'required',
            'item_id' => 'required',
            'branch_id' =>'required',
            'HSN_code'=> 'required',
            'SGST' =>'required',
            'CGST' =>'required',
            'item_name' =>'required',
            'item_rate' =>'required',
            'status' => 'required',

        ]);
        if($r->input('role')>2){
            return response()->json([
                'code' => 2,
                'message'=>'unauthorized operation'
            ]);

        }
        try{
            $cid=$r->input('item_id');
            $cat=foodItem::where('item_id',$cid)->first();
            $cat->update([
                'cat_id' => $r->input('cat_id'),
                'user_name' => $r->input('user_name'),

                'status' => $r->input('status'),
                'HSN_code' => $r->input('HSN_code'),
                'SGST' => $r->input('SGST'),
                'CGST' => $r->input('CGST'),
                'item_name' => $r->input('item_name'),
                'item_rate' => $r->input('item_rate'),
            ]);
        }
        catch (\Throwable $e){
            return response()->json([
                'code'=> 4,
                'message' => 'some error occured'
            ]);
        }
        return response()->json([
            'code' => 1,
            'message' => 'item updated successfully'
        ]);
    }

    public function delete(Request $r){

        $this->validate($r,[
            'user_name' => 'required',
            'role' =>'required',
            'item_id'=>'required'

        ]);

        if($r->input('role')>2){
            return response()->json([
                'code' => 2,
                'message'=>'unauthorized operation'
            ]);

        }
        $cid=$r->input('item_id');
        try{
            $cat=foodItem::where('item_id',$cid)->first();
            $cat->delete();
        }
        catch (\Throwable $e){
            return response()->json([
                'code'=> 4,
                'message' => 'some error occured'
            ]);
        }
        return response()->json([
            'code' => 1,
            'message' => 'item deleted successfully'
        ]);
    }
}
