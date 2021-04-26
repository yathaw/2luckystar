<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developer =User::create([
            'name' => 'Developer',
            'email' => 'developer@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        $developer->assignRole('Developer');

        $boss =User::create([
            'name' => 'Boss',
            'email' => 'boss@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        $boss->assignRole('Boss');

        $staff =User::create([
            'name' => 'Staff One',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        $staff->assignRole('Staff');
    }
}
