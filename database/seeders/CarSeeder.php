<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Car::create([
            'name'      => 'TOYOTA LANDCRUISER',
            'duration'  => '2020',
            'brand_id'  => 1
        ]);

        Car::create([
            'name'      => 'Toyota Avalon',
            'duration'  => '2019',
            'brand_id'  => 1
        ]);

        Car::create([
            'name'      => 'Toyota Camry',
            'duration'  => '2019',
            'brand_id'  => 1
        ]);

        Car::create([
            'name'      => 'Toyota Corolla',
            'duration'  => '2021',
            'brand_id'  => 1
        ]);

        Car::create([
            'name'      => 'Toyota Prius',
            'duration'  => '2020',
            'brand_id'  => 1
        ]);

        Car::create([
            'name'      => 'Toyota Alphard',
            'duration'  => '2020',
            'brand_id'  => 1
        ]);
    }
}
