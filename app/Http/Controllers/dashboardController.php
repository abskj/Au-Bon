<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restro;

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
            'gstin'=>'required'
            ]);
        if($request->input('role')!=0){
            return response()->json([
                'error'=>'permission-denied',
    
            ],402);
        }
        $restro=new Restro([
            'restro_name'=> $request->input('restro_name'),
            'gstin'=> $request->input('gstin'),
        ]);
        $restro->save();
        return response()->json([
            'valid'=>true,
            'restro added'=> $request->input('restro_name'),

        ],200);
    }
}
