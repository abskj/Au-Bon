<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class foodItem extends Model
{   protected $table='item_master';
    //
    protected $fillable=[
        'cat_id',
        'item_id',
        'HSN_code',
        'SGST',
        'CGST',
        'item_name',
        'user_name',
        'branch_id',
        'item_rate',
        'status'
    ];
}
