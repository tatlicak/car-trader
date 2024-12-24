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