<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restro extends Model
{
    protected $table='restro';
    //
    protected $fillable = [
        'restro_name',
        'gstin',
        

    ];
}
