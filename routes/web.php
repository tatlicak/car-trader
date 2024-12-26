<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShowCarController;
use App\Http\Controllers\MathOperationController;

Route::get('/', [HomeController ::class, 'index'])->name('home'); 

Route::get('/about', function () {
    return view('about');
});


Route::get('/hello/{name}/{surname}',[HelloController::class,'welcome'])->whereAlpha(['name','surname'])->name('hello.welcome');




