<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\User;
use App\Models\CarImage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Select the car
        $car = Car::find(1);

        // Create and attach an image to $car
        $image = new CarImage(['image_path' => 'your_path', 'position' => 2]);
        $car->images()->save($image);

        // the same as above
        $car->images()->create(['image_path' => 'your_path', 'position' => 2]);

        // Attach multiple images to $car
        $car->images()->saveMany([
            new CarImage(['image_path' => 'your_path2', 'position' => 3]),
            new CarImage(['image_path' => 'your_path3', 'position' => 4]),
        ]);

        // the same as above
        $car->images()->createMany([
            ['image_path' => 'your_path2', 'position' => 3],
            ['image_path' => 'your_path3', 'position' => 4],
        ]);

        $car = Car::find(1);

// Select all users who added the $car in favourites
dd($car->favouredUsers);

$user = User::find(1);

// Select all cars $users added into favourites
dd($user->favouriteCars);

$user = User::find(1);

// INSERT
// Add cars with IDs 1, 2, and 3 into favourites
$user->favouriteCars()->attach([1, 2, 3], ['column1' => 'value1']);

// Add cars with IDs 1, 2, and 3 into favourites, but delete all others
$user->favouriteCars()->sync([1, 2, 3]);

// If you want to provide pivot table additional values
$user->favouriteCars()->syncWithPivotValues([1, 2, 3], ['column1' => 'value1']);

// DELETE
// Delete cars from favourites with IDS: 1, 2, 3
$user->favouriteCars()->detach([1, 2, 3]);

// Delete all cars from favourites
$user->favouriteCars()->detach();

//Factory Relationships - Many to Many
User::factory()
    ->has(Car::factory()->count(5), 'favouriteCars')
    ->create();

User::factory()
    ->hasAttached(Car::factory()->count(5), ['column1' => 'value1'],'favouriteCars')
    ->create();    

        return view('home.index');
    }
}
