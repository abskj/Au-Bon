<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class settlement extends Model
{
    protected $table='settlement';

    protected $fillable = [
        'trans_id',
        'customer_id',
        'bill_amount',
        'settle_mode',
        'status_flag',
        'card_number',
       
    ];
}
