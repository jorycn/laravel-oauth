<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Webpatser\Uuid\Uuid;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
}
