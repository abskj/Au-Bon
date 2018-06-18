<?php

namespace App;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
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
    protected $hidden = [
        'password','remember_token',

    ];
}
