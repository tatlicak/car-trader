<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        /* //Select All CArs
        $cars = Car::get(); 

       // Select published Cars
        $cars = Car::where('published_at','!=', null)->get();

        // Select the first car
        $cars = Car::where('published_at','!=',null)->first(); 

        //find specific car
        $car = Car::find(2);*/
        $cars = Car::order('published_at','desc')->get();

        return view('home.index');
    }
}
