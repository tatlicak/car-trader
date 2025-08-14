<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Faker\Generator;
use App\Faker\ImageProvider;

class FakerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Container her Faker ürettiğinde provider'ı ekle
        $this->app->afterResolving(Generator::class, function (Generator $faker) {
            $faker->addProvider(new ImageProvider($faker));
        });

        // Ayrıca singleton'ı da bizim provider ile kur
        $this->app->singleton(Generator::class, function ($app) {
            $faker = \Faker\Factory::create($app->getLocale());
            $faker->addProvider(new ImageProvider($faker));
            return $faker;
        });
    }

    public function boot(): void {}
}
