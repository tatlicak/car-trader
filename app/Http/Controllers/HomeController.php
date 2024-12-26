<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'name' => 'John',
            'surname' => 'Doe'
        ]);

        // return view('home.index')
        //              ->with('name', 'John')
        //              ->with('surname', 'Doe'); 
    }
}
