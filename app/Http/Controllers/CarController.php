<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Rules\Phone;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = User::find(1)
            ->cars()
            ->with(['primaryImage', 'maker', 'model'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('car.index', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('car.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $data = $request->validate([
            'maker_id' => 'required',
            'model_id' => 'required',
            'year' => 'required|integer|min:1970|max:' . date('Y'),
            'phone'=>'required|string|min:10',
            'price' => 'required|integer|min:0',
            'vin' => 'required|string|max:17',
            'mileage' => 'required|integer|min:0',
            'car_type_id' => 'required|exists:car_types,id',
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string',
            'description' => 'nullable|string',
            'features'=>'array',
            'features.*'=>'string',
            //'phone'=> new Phone(),
            'published_at' => 'nullable|date',
            'images' => 'array',
            //'images.*'=>'image|mimes:jpeg,jpg,png,webp,gif|max:2408',
            'images.*'=> File::image()->max(2048)
        ]);


        $data['user_id'] = 1;

        $featuresData = $data['features'] ?? [];

        $images = $request->file('images') ?: [];

        $car = Car::create($data);

        $car->features()->create($featuresData);


        foreach ($images as $i => $image) {

            $path = $image->store('public/images');
            $car->images()->create(['image_path' => $path, 'position' => $i + 1]);
        }

        return redirect()->route('car.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        if (!$car->published_at) {

            abort('404');
        }
        return view('car.show', ['car' => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('car.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }

    public function search(Request $request)
    {

        $maker = $request->input('maker_id');
        $model = $request->input('model_id');
        $state = $request->input('state_id');
        $city = $request->input('city_id');
        $carType = $request->input('car_type_id');
        $yearFrom = $request->input('year_from');
        $yearTo = $request->input('year_to');
        $priceFrom = $request->input('price_from');
        $priceTo = $request->input('price_to');
        $fuelType = $request->input('fuel_type_id');
        $mileage = $request->input('mileage');
        $sort = $request->input('sort', 'published_at');

        $query = Car::with(['city', 'primaryImage', 'maker', 'model', 'fuelType', 'carType'])
            ->where('published_at', '<', now());

        if ($maker) {

            $query->where('maker_id', $maker);
        }

        if ($model) {

            $query->where('model_id', $model);
        }

        if ($state) {

            $query->whereHas('city', function ($q) use ($state) {
                $q->where('state_id', $state);
            });

            // $query->join('cities', 'cars.city_id', '=', 'cities.id')
            //       ->where('cities.state_id', $state);

        }

        if ($city) {

            $query->where('city_id', $city);
        }

        if ($carType) {

            $query->where('car_type_id', $carType);
        }

        if ($yearFrom) {

            $query->where('year', '>=', $yearFrom);
        }

        if ($yearTo) {

            $query->where('year', '<=', $yearTo);
        }

        if ($priceFrom) {

            $query->where('price', '>=', $priceFrom);
        }

        if ($priceTo) {

            $query->where('price', '<=', $priceTo);
        }

        if ($fuelType) {

            $query->where('fuel_type_id', $fuelType);
        }

        if ($mileage) {

            $query->where('mileage', '<=', $mileage);
        }

        if (str_starts_with($sort, '-')) {

            $sort = substr($sort, 1);

            $query->orderBy($sort, 'desc');
        } else {

            $query->orderBy($sort);
        }



        $cars = $query->paginate(5)->withQueryString();

        return view('car.search', ['cars' => $cars]);
    }

    public function watchlist()
    {
        $cars = User::find(4)
            ->favouriteCars()
            ->with(['city', 'primaryImage', 'maker', 'model', 'fuelType', 'carType'])
            ->paginate(15);

        return view('car.watchlist', ['cars' => $cars]);
    }
}
