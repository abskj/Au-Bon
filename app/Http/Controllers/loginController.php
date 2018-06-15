<?php

namespace App\Http\Controllers;
use App\Http\Controllers\dashboardController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class loginController extends Controller
{
    //
    public function login(Request $request){
        $username=$request->input('username');
        $password=$request->input('password');
        $pass=DB::table('user_login')->where(['user_name'=>$username])->value('password');
        $check=Hash::check($password, $pass);
        if($check){

        }
        else{
            echo 'unsuccesful';
        }
    }

    public function signin(Request $req){
        return response()->json([
            'flag'=>'1'

        ],200);
    }
}
