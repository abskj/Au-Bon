<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class foodCategory extends Model
{   protected $table='food_category_master';
    protected $fillable=[
        'cat_id',
        'cat_name',
        'type',
        'user_name',
        'stat_flag',
        'branch_id',
    ];
    //
}
