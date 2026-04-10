<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardContoller extends Controller
{
    public function index(){
        
        return view('dashboard');
    }
}
