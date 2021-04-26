<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
        	'name' => 'Toyota',
	    ]);

	    Brand::create([
        	'name' => 'Suzuki',
	    ]);

	    Brand::create([
        	'name' => 'Nissan',
	    ]);

	    Brand::create([
        	'name' => 'Honda',
	    ]);

        Brand::create([
            'name' => 'Lexus',
        ]);
    }
}
