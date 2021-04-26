<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CarSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(ExpensetypeSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserPermissionSeeder::class);
        
        

    }
}
