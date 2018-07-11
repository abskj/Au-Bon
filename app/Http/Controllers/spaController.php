<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class spaController extends Controller
{
    //
    public function index()
    {
        return view('spa');
    }
}
