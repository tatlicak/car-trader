<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShowCarController;
use App\Http\Controllers\MathOperationController;
use App\Http\Controllers\SignupController;

Route::get('/', [HomeController ::class, 'index'])->name('home'); 

Route::get('/signup', [SignupController::class, 'create'])->name('signup.create');

Route::get('/login',[LoginController::class,'show'])->name('login.show');
