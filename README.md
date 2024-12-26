# Grap Car Project
- This is for my Laravel 11 Tutorial Project

## Artisan Command to view Existing Routes

``` php artisan route:list ```
- Lists all routes 

``` php artisan route:list -v ```
- Lists routes with middleware

``` php artisan route:list --except-vendor ```
- Lists routes which are defined by us

``` php artisan route:list --only-vendor ```
- Lists routes which are defined by vendor

``` php artisan route:list --path=api ```
- Lists all routes which are part of api

``` php artisan route:list -v --except-vendor --path=admin ```
- We can combine these flags

``` php artisan route:cache ``` 

- When you deploy your laravel project to production it is recommended

``` php artisan route:clear ``` 

- Clears route cache

# MAKING CONTROLLER
- Controller is a class which is associated to one or more routes and responsible for handling request of that routes

``` php artisan make:controller CarController```

## Single Action Controller
**Single Action Controllers** are controllers that are associated to a single route only.

``` php artisan make:controller ShowCarController --invokable```
or

``` php artisan make:controller ShowCarController -i```

## Resource Controller

- In Laravel "Resource Controller" is a special type of controller that provides a covinient way to handle typical CRUD operation for aresource such as database table
``` php artisan make:controller ProductController --resource ```

- Resource Controller for API

``` php artisan make:controller CarController --api ```

So on web.php content for practice

``` // Route with parameters ```
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

Route::get('/sum/{a}/{b}', function (float $a, float $b) {

   echo "Sum of $a and $b is ".($a+$b);

})->whereNumber(['a','b']);


/* Route::get('/car', [CarController::class, 'index'])->name('car.index');

Route::controller(CarController::class)->group(function() {
    Route::get('car', 'index')->name('car.index');
    Route::get('/my-cars', 'createmyCars')->name('car.my-cars');
    
}); */

/* Route::get('/car', ShowCarController::class)->name('car.index'); */

Route::get('/car/invokable', CarController::class)->name('car.invokable');
Route::get('/car', [CarController::class, 'index'])->name('car.index');

//Create and Edit routes are not used in Controller
#Route::resource('/products', ProductController::class)->except(['create','edit']);

//Only Index and Show routes are used in Controller
#Route::resource('/products', ProductController::class)->only(['index','show']);  

//Resource Controller for API
#Route::apiResource('/products', ProductController::class);


//Resource Controller for API with multiple resources
/* Route::apiResources([
    'products' => ProductController::class,
    'cars' => CarController::class
]) */;

Route::group(['prefix'=>'operations'], function() {
    
    Route::get('/sum/{num1}/{num2}', [ MathOperationController::class, 'sum' ])->whereNumber(['num1','num2'])->name('sum');
    Route::get('/subtract/{num1}/{num2}', [MathOperationController::class,'subtract'])->whereNumber(['num1','num2'])->name('subtract');
    
});


# Views 
- Views are files, that are responsible for presentation logic in your Laravel Applications and are stored under resources/views folder
- Blade is Laravel's templatinf engine that helps you to build HTML views efficiently. It allows mixing HTML with PHP using simple and clean syntax

## Blade Core Features
- - extension : *.blade.php
- - Template Inheritance
- - Directives 
- - Components & Slots

``` php artisan make:view index ```

## Using View Facades
return View::make('home.index');

        //Return the first view that exists
        //return View::first(['index','home.index']);