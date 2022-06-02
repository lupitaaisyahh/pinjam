<?php

namespace App\Http\Controllers;
use Mail;


use App\Http\Controllers\Controller;
use Visitor;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
