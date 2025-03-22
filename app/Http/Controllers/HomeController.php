<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Carbon\Carbon;
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
        $car = Car::find(2);
        $cars = Car::orderBy('published_at','desc')->get();*/
        /* 
        $car = new Car();

        $car->maker_id =  1;
        $car->model_id = 1;
        $car->year = 2002;
        $car->price = 150_000;
        $car->vin = 159852369;
        $car->mileage = 250_133;
        $car->car_type_id = 1;
        $car->fuel_type_id = 1;
        $car->user_id = 1;
        $car->city_id = 1;
        $car->address = 'Est nulla ad magna esse ad.';
        $car->phone = "5556667788";
        $car->description = 'Ullamco velit ullamco adipisicing sit fugiat esse aliquip ut Lorem dolore irure anim. Occaecat pariatur commodo incididunt labore voluptate culpa. Amet exercitation occaecat quis adipisicing officia ut pariatur deserunt labore voluptate cupidatat in exercitation tempor. Duis id ea quis velit laborum pariatur et aliquip ut dolor. Laboris minim commodo laborum est ut nisi. Exercitation ea deserunt culpa qui occaecat id voluptate minim. Lorem elit ex deserunt magna occaecat voluptate minim consequat consequat in.';
        $car->published_at = Carbon::now();
        $car->save(); */
        /* 
        $carData = [
                'maker_id' =>  1,
                'model_id' => 1,
                'year' => 2002,
                'price' => 150_000,
                'vin' => 159852369,
                'mileage' => 250_133,
                'car_type_id' => 1,
                'fuel_type_id' => 1,
                'user_id' => 1,
                'city_id' => 1,
                'address' => 'Est nulla ad magna esse ad.',
                'phone' => "5556667788",
                'description' => 'Ullamco velit ullamco adipisicing sit fugiat esse aliquip ut Lorem dolore irure anim. Occaecat pariatur commodo incididunt labore voluptate culpa. Amet exercitation occaecat quis adipisicing officia ut pariatur deserunt labore voluptate cupidatat in exercitation tempor. Duis id ea quis velit laborum pariatur et aliquip ut dolor. Laboris minim commodo laborum est ut nisi. Exercitation ea deserunt culpa qui occaecat id voluptate minim. Lorem elit ex deserunt magna occaecat voluptate minim consequat consequat in.',
                'published_at' => Carbon::now(),
        ];

        // Approach -1

        $car2 = new Car();
        $car2->fill($carData);
        $car2->save();

        // Approach -2
        $car3 = new Car($carData);
        $car3->save();

        //Approach -3

        $car4 = Car::create($carData); */

        /* $car = Car::find(1);

        $car->price = 1000;

        $car->save(); */

        /*  Car::updateOrCreate(
            ['vin' => '159852369', 'price'=>150_000],
            ['price'=> 200_000]
        );

 */
        $carData = [
            'maker_id' =>  1,
            'model_id' => 1,
            'year' => 2002,
            'price' => 250_000,
            'vin' => 'VIN159852369',
            'mileage' => 250_133,
            'car_type_id' => 1,
            'fuel_type_id' => 1,
            'user_id' => 1,
            'city_id' => 1,
            'address' => 'Est nulla ad magna esse ad.',
            'phone' => "5556667788",
            'description' => 'Ullamco velit ullamco adipisicing sit fugiat esse aliquip ut Lorem dolore irure anim. Occaecat pariatur commodo incididunt labore voluptate culpa. Amet exercitation occaecat quis adipisicing officia ut pariatur deserunt labore voluptate cupidatat in exercitation tempor. Duis id ea quis velit laborum pariatur et aliquip ut dolor. Laboris minim commodo laborum est ut nisi. Exercitation ea deserunt culpa qui occaecat id voluptate minim. Lorem elit ex deserunt magna occaecat voluptate minim consequat consequat in.',
            'published_at' => Carbon::now(),
        ];
        Car::updateOrCreate(
            ['vin' => 'VIN159852369', 'price' => 250_000],
            $carData
        );
        return view('home.index');
    }
}
