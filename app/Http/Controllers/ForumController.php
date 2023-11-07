<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumController extends Controller
{
    function index()
    {
        return view('product.index',['page'=>'Forum']);
    }
}
