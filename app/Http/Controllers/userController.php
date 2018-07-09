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
        $user= User::where('user_name',$request->input('user_name'))->get()->first();
        return \response()->json([
            'message'=>'success',
            'token'=>$token,
            'status'=>$user->status,
            'role'=>$user->role,
            'full_name'=>$user->user_fname,
            'restro_id' => $user->restro_id,
            'branch_id' => $user->branch_id,

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
    public function createManager(Request $request){

        $this->validate($request, [
            'user_name' => 'required|unique:user_login',
            'password' => 'required',
            'aadhar_no' => 'required',
            'user_fname' => 'required',
            'admin_name' =>'required',
            'restro_id' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'voter_id' => 'nullable',
            'branch_id' => 'required',

        ]);
        $username=$request->input('admin_name');
        try {
            $admin = User::find($username);
            if (($admin->role) != 0) {
                return \response()->json([
                    'code' => 2,
                    'message' => 'unauthorized request'
                ], 403);
            }
        }
        catch(\Throwable $e){
            return response()->json(
                [
                    'code' => 2,
                    'message' => 'admin record not found'
                ],404
            );
        }
        $manager= new User([
            'user_name' => $request->input('user_name'),
            'password' => bcrypt($request->input('password')),
            'user_fname' => $request->input('user_fname'),
            'restro_id' => $request->input('restro_id'),
            'aadhar_no' => $request->input('aadhar_no'),
            'address' => $request->input('address'),
            'voter_card_no' => $request->input('voter_id'),
            'mobile' => $request->input('mobile'),
            'branch_id' => $request->input('branch_id'),
            'status' => 1,
            'role' => 1,

        ]);
        $manager->save();
        return response()->json(
            [
                'code' => 1,
                'message' => 'New Manager created',
            ],201
        );



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

    public function createStaff(Request $request){
        $this->validate($request, [
            'user_name' => 'required|unique:user_login',
            'password' => 'required',
            'aadhar_no' => 'required',
            'user_fname' => 'required',
            'admin_name' =>'required',
            'restro_id' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'voter_id' => 'nullable',
            'branch_id' => 'required',

        ]);
        $username=$request->input('admin_name');
        try {
            $admin = User::find($username);
            if (($admin->role) > 2) {
                return \response()->json([
                    'code' => 2,
                    'message' => 'unauthorized request'
                ], 403);
            }
        }
        catch(\Throwable $e){
            return response()->json(
                [
                    'code' => 2,
                    'message' => 'admin record not found'
                ],404
            );
        }
        $staff= new User([
            'user_name' => $request->input('user_name'),
            'password' => bcrypt($request->input('password')),
            'user_fname' => $request->input('user_fname'),
            'restro_id' => $request->input('restro_id'),
            'aadhar_no' => $request->input('aadhar_no'),
            'address' => $request->input('address'),
            'voter_card_no' => $request->input('voter_id'),
            'mobile' => $request->input('mobile'),
            'branch_id' => $request->input('branch_id'),
            'status' => 1,
            'role' => 3,

        ]);
        $staff->save();
        return response()->json(
            [
                'code' => 1,
                'message' => 'New Staff created',
            ],201
        );



    }

}
