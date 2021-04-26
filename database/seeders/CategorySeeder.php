<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Wiper',
        ]);

        Category::create([
            'name' => 'Fenders',
        ]);

        Category::create([
            'name' => 'Step Bumpers',
        ]);

        Category::create([
            'name' => 'Mirrors',
        ]);

        Category::create([
            'name' => 'Radiator Supports',
        ]);

        Category::create([
            'name' => 'Doors',
        ]);

        Category::create([
            'name' => 'Tail Lights',
        ]);

        Category::create([
            'name' => 'Headlights',
        ]);


        Category::create([
            'name' => 'Bumpers',
        ]);

    }
}
