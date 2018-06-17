<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;

class userController extends Controller
{
    //
    public function login(Request $request){

    }

    public function create(Request $request){

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
