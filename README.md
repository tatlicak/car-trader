# Grap Car Project
- This is for my Laravel 11 Tutorial Project

## Artisan Command to view Existing Routes

### php artisan route:list 
- Lists all routes 

### php artisan route:list -v
- Lists routes with middleware

### php artisan route:list --except-vendor
- Lists routes which are defined by us

### php artisan route:list --only-vendor
- Lists routes which are defined by vendor

### php artisan route:list --path=api
- Lists all routes which are part of api

### php artisan route:list -v --except-vendor --path=admin
- We can combine these flags