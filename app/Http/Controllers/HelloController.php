<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function welcome($name, $surname)
    {
        return view('hello.welcome', ['name' => $name, 'surname' => $surname]);
    }
}
