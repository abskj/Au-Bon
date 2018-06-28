<?php

namespace App\Http\Controllers;

use App\foodCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class foodCategoryController extends Controller
{
    //
    public function get(Request $r){
        $this->validate($r,[
            'user_name' => 'required',
            'role' =>'required',
            'branch_id' =>'required',

        ]);
        $cats=foodCategory::where('branch_id',$r->input('branch_id'))->get();
        return response()->json([
            'code' => 1,
            'data' => $cats,
        ]);
    }

    public function create(Request $r){
        $this->validate($r,[
            'user_name' => 'required',
            'role' =>'required',
            'cat_id' => 'required|unique:food_category_master',
            'type' =>'required',
            'cat_name' =>'required',
            'stat_flag' => 'required',
            'branch_id' =>'required',
        ]);
        if($r->input('role')>2){
            return response()->json([
                'code' => 2,
                'message'=>'unauthorized operation'
            ]);

        }
        $cat=new foodCategory([
            'cat_id' => $r->input('cat_id'),
            'cat_name' => $r->input('cat_name'),
            'type' => $r->input('type'),
            'user_name' => $r->input('user_name'),
            'branch_id' => $r->input('branch_id'),
            'stat_flag' => 1,
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
            'message' => 'category created successfully'
        ]);
    }

    public function update(Request $r){
        $this->validate($r,[
            'user_name' => 'required',
            'role' =>'required',
            'cat_id'=>'required',
            'type' =>'required',
            'cat_name' =>'required',
            'stat_flag' => 'required',
            'branch_id' =>'required',

        ]);
        if($r->input('role')>2){
            return response()->json([
                'code' => 2,
                'message'=>'unauthorized operation'
            ]);

        }
        try{
            $cid=$r->input('cat_id');
            $cat=foodCategory::where('cat_id',$cid)->first();
            $cat->update([
                'cat_name' => $r->input('cat_name'),
                'type' => $r->input('type'),
                'user_name' => $r->input('user_name'),
                'branch_id' => $r->input('branch_id'),
                'stat_flag' => $r->input('stat_flag'),
            ]);
        }
        catch (\Tmhrowable $e){
            return response()->json([
                'code'=> 4,
                'message' => 'some error occured'
            ]);
        }
        return response()->json([
            'code' => 1,
            'message' => 'category updated successfully'
        ]);
    }

    public function delete(Request $r){
        $this->validate($r,[
            'user_name' => 'required',
            'role' =>'required',
            'cat_id'=>'required'

        ]);
        if($r->input('role')>2){
            return response()->json([
                'code' => 2,
                'message'=>'unauthorized operation'
            ]);

        }
        $cid=$r->input('cat_id');
        try{
            $cat=foodCategory::where('cat_id',$cid)->first();
            $cat->delete();
        }
        catch (\Tmhrowable $e){
            return response()->json([
                'code'=> 4,
                'message' => 'some error occured'
            ]);
        }
        return response()->json([
            'code' => 1,
            'message' => 'category deleted successfully'
        ]);
    }
}
