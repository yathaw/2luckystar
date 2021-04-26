<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Color::create([
            'name' => 'White',
            'code' => '#ffffff'
        ]);

        Color::create([
            'name' => 'Black',
            'code' => '#000000'
        ]);

        Color::create([
            'name' => 'Gray',
            'code' => '#707070'
        ]);

        Color::create([
            'name' => 'Brown',
            'code' => '#A52A2A'
        ]);

        Color::create([
            'name' => 'Green',
            'code' => '#4caf50'
        ]);

        Color::create([
            'name' => 'Light-Green',
            'code' => '#8cc152'
        ]);

        Color::create([
            'name' => 'Lime',
            'code' => '#cdda49'
        ]);

        Color::create([
            'name' => 'Yellow',
            'code' => '#fdd835'
        ]);

        Color::create([
            'name' => 'Orange',
            'code' => '#fd9727'
        ]);

        Color::create([
            'name' => 'Deep-Orange',
            'code' => '#fc5830'
        ]);

        Color::create([
            'name' => 'Red',
            'code' => '#e53935'
        ]);


        Color::create([
            'name' => 'Deep-Purple',
            'code' => '#673fb4'
        ]);

        Color::create([
            'name' => 'Blue',
            'code' => '#1976d2'
        ]);

        Color::create([
            'name' => 'Light-Blue',
            'code' => '#039be5'
        ]);

        
    }
}
