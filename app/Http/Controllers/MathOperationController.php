<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MathOperationController extends Controller
{
    public function sum($num1, $num2)
    {
        return $num1 + $num2;
    }

    public function subtract($num1, $num2)
    {
        return $num1 - $num2;
    }   

}
