<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});


// Route with parameters
// It is possible to define the type of parameter that the route will receive
// In this case, the route will only be accessed if the parameter is a number
Route::get('product/{id}', function(string $id) {

    return "Works! $id";

})->whereNumber('id')->name('product');

// In this case, the route will only be accessed if the parameter is a string

Route::get('user/{username}', function(string $username) {

    return "Works! $username";

})->whereAlpha('name')->name('user');

// In this case, the route will only be accessed if the parameter is a string or a number

Route::get('user/{username}', function(string $username) {

    return "Works! $username";

})->whereAlphaNumeric('name')->name('user-alpha');

// In this case, the route will only be accessed if the lang parameter is a string and the id parameter is a number

Route::get('{lang}/product/{id}', function(string $lang, string $id) {

    return "Works! $id in $lang";

})
    ->whereAlpha('lang')
    ->whereNumber('id')->name('product-lang');


Route::get('{lang}/products', function(string $lang) {

        return "Works! products in $lang";
    
    })->whereIn("lang",["en","tr","ro"])->name('product-lang');