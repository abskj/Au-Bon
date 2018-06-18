<?php

namespace App\Http\Controllers;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class userController extends Controller
{
    //
    public function login(Request $request){
        $this->validate($request, [
            'user_name' => 'required',
            'password' => 'required'
            ]);
        $credentials = $request->only('user_name','password');
        try{
            if(!$token=JWTAuth::attempt($credentials)){
                return \response()->json([
                    'error' => 'Invalid Credentials'
                ],401);
            }
        }catch (JWTException $e){
            return response('Server Error',500);
        }
        return \response()->json([
            'message'=>'success',
            'token'=>$token
        ],201);


    }

    public function create(Request $request){
        $this->validate($request, [
            'user_name' => 'required|unique:user_login',
            'password' => 'required',
            'status' => 'required',
            'role' => 'required',
            'aadhar_no' => 'required',
            'user_fname' => 'required'
        ]);

        $user = new User([
            'user_name' => $request->input('user_name'),
            'user_fname' => $request->input('user_fname'),
            'password' => bcrypt($request->input('password')),
            'status' => $request->input('status'),
            'role' => $request->input('role'),
            'aadhar_no' => $request->input('aadhar_no')
        ]);
        $user->save();

        return response()->json([
            'message' => 'success on user creation'
        ],205);

    }
    public function delete(Request $request){

    }

    public function update(Request $request){

    }
    public function test(Request $request){
        return response()->json([
            'request'=>$request,
            'read'=>'true'
        ],201);
    }

}
