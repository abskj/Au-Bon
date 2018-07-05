<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bill_transaction extends Model
{
    //
    protected $table="bill_transaction";
    protected $fillable=[
      'tran_id',
        'cust_id',
        'bill_amount',
        'date_time',
        'user_name',
        'discount',
        'net_billed',
        'branch_id',
        'gst_comp',
        'table_no',
        'steward_id',

    ];
}
