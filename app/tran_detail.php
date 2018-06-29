<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tran_detail extends Model
{
    //
    protected $table="tran_detail";
    protected $fillable=[
        'tran_id',
        'cat_id',
        'item_id',
        'qty',
        'rate',
        'total',
        'date_time',
        'branch_id',
    ];
}
