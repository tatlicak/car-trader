<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Rules\Phone;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use App\Http\Requests\StoreCarRequest;
use Illuminate\Support\Facades\Storage;

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
    public function store(StoreCarRequest $request)
    {

        $data = $request->validated();


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
        return view('car.edit', ['car' => $car]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCarRequest $request, Car $car)
    {
        $data = $request->validated();
        $data['features'];
        $features = array_merge([
            'abs' => 0,
            'air_conditioning' => 0,
            'power_windows' => 0,
            'power_door_locks' => 0,
            'cruise_control' => 0,
            'bluetooth_connectivity' => 0,
            'remote_start' => 0,
            'gps_navigation' => 0,
            'heated_seats' => 0,
            'climate_control' => 0,
            'rear_parking_sensors' => 0,
            'leather_seats' => 0,
        ], $data['features'] ?? []);


        $car->update($data);

        //Update Car Features

        $car->features()->update($features);

        return redirect()->route('car.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('car.index');
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

    public function carImages(Car $car)
    {
        return view('car.images', ['car' => $car]);
    }

    public function updateImages(Request $request, Car $car)
    {

        // Get Validated data of delete images and positions
        $data = $request->validate([
            'delete_images' => 'array',
            'delete_images.*' => 'integer',
            'positions' => 'array',
            'positions.*' => 'integer',
        ]);

        $deleteImages = $data['delete_images'] ?? [];
        $positions = $data['positions'] ?? [];

        // Select images to delete
        $imagesToDelete = $car->images()->whereIn('id', $deleteImages)->get();

        // Iterate over images to delete and delete them from file system
        foreach ($imagesToDelete as $image) {
            if (Storage::exists($image->image_path)) {
                Storage::delete($image->image_path);
            }
        }

        // Delete images from the database
        $car->images()->whereIn('id', $deleteImages)->delete();

        // Iterate over positions and update position for each image, by its ID
        foreach ($positions as $id => $position) {
            $car->images()->where('id', $id)->update(['position' => $position]);
        }

        // Redirect back to car.images route
        return redirect()->back();
    }

    public function addImages(Request $request, Car $car) 
    {
        // Get images from request
        $images = $request->file('images') ?? [];

        // Select max position of car images

        $position = $car->images()->max('position') ?? 0;

        foreach ($images as $image) {
            
            $path = $image->store('public/images');
            $car->images()->create([
                'image_path' => $path,
                'position' => $position + 1
            ]);

            $position++;
        }

    }
}
