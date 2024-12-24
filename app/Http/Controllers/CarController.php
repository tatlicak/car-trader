<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public function __invoke()
    {
        return 'Hello from __invoke function in CarController';
    }
    
    public function index()
    {
        return 'Hello from CarController';
    }
}
