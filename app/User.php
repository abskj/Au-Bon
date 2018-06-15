<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table='user_login';
    protected $keyType=string;
    protected $primaryKey='user_name';
}
