<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => 'Thaiwan',
            'flag' => '/storage/country/tw.png'
        ]);

        Country::create([
            'name' => 'Japan',
            'flag' => '/storage/country/jp.png'
        ]);

        Country::create([
            'name' => 'Thailand',
            'flag' => '/storage/country/th.png'
        ]);

        Country::create([
            'name' => 'Hong Kong',
            'flag' => '/storage/country/hk.png'
        ]);

        Country::create([
            'name' => 'India',
            'flag' => '/storage/country/in.png'
        ]);
    }
}
