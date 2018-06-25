<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //
    protected $table='branch';
    protected $fillable = [
        'address',
        'restro_id',
        'pin',
        'phone',
         ];
}
