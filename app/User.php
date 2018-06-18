<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table='user_login';
    protected $primaryKey='user_name';
    protected $fillable = [
        'user_name',
        'password',
        'user_fname',
        'status',
        'role',
        'aadhar_no'

    ];
}
