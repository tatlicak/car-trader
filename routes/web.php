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

// In this case, the route will only be accessed if the lang parameter is only one of the values in the array

Route::get('{lang}/products', function(string $lang) {

        return "Works! products in $lang";
    
    })->whereIn("lang",["en","tr","ro"])->name('product-lang');

// Route with parameters validated by a regular expression(regex)
// In this case, the route will only be accessed if the parameter is lowercase
Route::get('user/regex/{username}', function(string $username) {

    return "Works! $username";

})->where('username','[a-z]+')->name('user-regex');

// In this case, the route will only be accessed if the lang parameter is 2 character lowercase and the id parameter is a number with at least 4 digits
Route::get('{lang}/product/regex/{id}', function(string $lang, string $id) {

    return "Works! $id in $lang";

})->where(['lang'=>'[a-z]{2}','id'=>'\d{4,}'])->name('product-lang-regex');   


// At least one character and accepts / like parameter
Route::get('search/{search}', function(string $search) {

    return "Works! $search";

})->where('search','.+')->name('search');

// define a route with name "profile"
Route::get('/user/profile', function () {
    // ...
})->name('profile');

//Named Routes Example with redirect
Route::get("/current-user", function() {
    // Generating Redirects...
    return redirect()->route('profile');
    // or
    return to_route('profile');
});

// Grouping Routes
Route::prefix('admin')->group(function () {
    Route::get('users', function () {
        // Matches The "/admin/users" URL

        return "/admin/users";
    });
});

// Grouping Routes with name
Route::name('admin')->group(function () {
    Route::get('users', function () {
        // Matches The "/admin/users" URL

        return "/users";
    })->name('users');
});

//Fallback Route
Route::fallback(function () {
    return "Fallback : 404 Not Found";
});