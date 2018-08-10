<?php
namespace App\Http\Controllers;
use App\bill_transaction;
use App\steward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
class TransactionController extends Controller{
    /*
    type index:(divisible by)
    1   all
    2   contains from date
    3   contains to date
    5   customer number
    \
    */
    
    public function getList(Request $r){
        $this->validate($r,[
            'username' => 'required',
            'branch_id' => 'required',
            'type' => 'required',
            
        ]);
        
        $trans = DB::table('bill_transaction');
        $type=$r->input('type');
        if($type%5==0){
            $trans=$trans->where('cust_id',$r->input('cust_id'));
        }
        if($type%2==0){
            $fromDate=date($r->input('fromDate'));
            $trans=$trans->whereDate('created_at','>=',$fromDate);
        }
        if($type%3==0){
            $toDate=date($r->input('toDate'));
            $trans=$trans->whereDate('created_at','<=',$toDate);
        }

        $trans=$trans->paginate(15);


        return response()->json([
            'data'=>$trans,

        ]);
    }
    public function getStat(Request $request){
        $this->validate($request, [
            'to_date' => 'required',
            'from_date' => 'required',
            'user_name' => 'required',
            'branch_id' => 'required',
        ]);
        $from = date($request->input('from_date'));
        $to = date($request->input('to_date'));
        $trans = DB::table('settlement');
        $trans=$trans->whereDate('created_at','>=',$from);
        $trans=$trans->whereDate('created_at','<=',$to);
        $total_val=$trans->sum('bill_amount');
        $cash_val=$trans->where('settle_mode',0)->sum('bill_amount');
        $card_val=DB::table('settlement')->whereDate('created_at','>=',$from)
        ->whereDate('created_at','<=',$to)->where('settle_mode',1)->sum('bill_amount');
        return response()->json([
            'total' => $total_val,
            'cash_val' => $cash_val,
            'card_val' => $card_val,
        ]);

    }
}