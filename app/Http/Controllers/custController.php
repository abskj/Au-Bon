<?php

namespace App\Http\Controllers;

use App\customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class custController extends Controller
{
    //
    public function create(Request $request){
       $this->validate($request,[
            'mobile'=>'required',
           'name'=>'required',
            'address'=>'required',
        ]);
       try{
           $cust=new customer([
               'name' => $request->input('name'),
               'mobile' => $request->input('mobile'),
               'address' => $request->input('address'),
           ]);
           $cust->save();
       }catch (\Throwable $e){
           return response()->json([
               'code'=>4,
               'message'=>'customer could not be created',
           ],400);
       }
        // $username = urlencode("DUMMY"); 
        //
        // $msg_token = urlencode("DUMMY"); 
        // $sender_id = urlencode("TKBNGO"); // optional (compulsory in transactional sms) 
        // $message = urlencode("Message".$x."text will be provided"); 
        // $mobile = urlencode($request->input('cust_id')); 

        // $api = "http://managed.sms.techbongo.com/api/send_transactional_sms.php?username=".$username."&msg_token=".$msg_token."&sender_id=".$sender_id."&message=".$message."&mobile=".$mobile.""; 

        // $response = file_get_contents($api);
       return response()->json([
           'code'=>1,
           'message'=>'customer created successfully',
       ]);
    }
}
