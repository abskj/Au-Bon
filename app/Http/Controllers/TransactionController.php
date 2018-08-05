<?php
namespace App\Http\Controllers;
use App\bill_transaction;
use App\steward;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class TransactionController extends Controller{
    /*
    type index:(divisible by)
    17   all
    2   contains from date
    3   contains to date
    5   customer number
    7   food category
    11  food item   
    */
    
    public function getList(Request $r){
        $this->validate($r,[
            'username' => 'required',
            'branch_id' => 'required',
            'type' => 'required',
        ]);
        
        $trans = bill_transaction::paginate(15);
        return response()->json([
            'data'=>$trans,

        ]);
    }
}