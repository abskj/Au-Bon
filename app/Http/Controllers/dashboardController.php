<?php

namespace App\Http\Controllers;

use App\foodCategory;
use App\User;
use Illuminate\Http\Request;
use App\Restro;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function show(){
        return view('dashboard');
    }

    public function addRestro(Request $request){
        $this->validate($request, [
            'user_name' => 'required',
            'role' => 'required',
            'restro_name' =>'required',
            'gstin'=>'required',
            'gst_comp' =>'required',
            ]);
        if($request->input('role')!=0){
            return response()->json([
                'error'=>'permission-denied',
                'code'=>2,
    
            ],402);
        }
        $restro=new Restro([
            'restro_name'=> $request->input('restro_name'),
            'gstin'=> $request->input('gstin'),
            'gst_comp'=>$request->input('gst_comp'),
        ]);
        $restro->save();
        return response()->json([
            'valid'=>true,
            'restro added'=> $request->input('restro_name'),
            'code'=>1,
            'restro' => $restro,

        ],200);
    }

    public function delRestro(Request $request){
        $this->validate($request, [
            'user_name' => 'required',
            'role' => 'required',
            'restro_id'=>'required'
        ]);
        if($request->input('role')!=0){
            return response()->json([
                'error'=>'permission-denied',
                'code'=>2,

            ],402);
        }
        try {
            $restro = Restro::find($request->input('restro_id'));
            $restro->delete();
        }
        catch(\Throwable $ex){
                 return response()->json([
                     'code'=>3,
                'message'=>'restro not found',
                'error'=>1,
                'error-message'=>$ex->getMessage(),
            ],300);
        }

        return response()->json([
            'code'=>1,
            'valid'=>true,
            'restro deleted successfully'=> $restro->value('restro_name'),

        ],200);
    }

    public function getRestro(Request $request){
        $this->validate($request, [
            'user_name' => 'required',
            'role' => 'required',

        ]);
        if($request->input('role')!=0){
            return response()->json([
                'code'=>2,
                'error'=>'permission-denied',

            ],402);
        }
       $restros=Restro::all('*');
        return response()->json([
            'code'=>1,
            'restro_data'=>$restros,

        ],200);
    }

    public function addFoodCategory(Request $request){

        $this->validate($request,[
            'cat_id'=>'required',
            'cat_name'=>'required',
            'type'=>'required',
            'user_name'=>'required',

        ]);
        if($request->input('role')==2){
            return response()->json([
                'error'=>'permission-denied',

            ],402);
        }
        $username=$request->input('user_name');
        $branch=DB::table('user_login')->where('user_name', $username)->first()->value('branch_id')->get();
        $fc=new foodCategory([
            'cat_id' => $request->input('cat_id'),
            'cat_name' => $request->input('cat_name'),
            'type' => $request->input('type'),
            'user_name' => $request->input('user_name'),
            'stat_flag' => 1,
            'branch' => $branch,
        ]);
        $fc->save();
        return response()->json([
            'message'=>'Food category added'
        ],201);
    }
}
