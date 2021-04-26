<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::get();
    	
        foreach ($permissions as $permission) {
    		DB::table('model_has_permissions')->insert([
	            'permission_id' => $permission->id,
	            'model_type' => 'App\Models\User',
	            'model_id' => 1,
	        ]);
    	}

    	foreach ($permissions as $permission) {
    		DB::table('model_has_permissions')->insert([
	            'permission_id' => $permission->id,
	            'model_type' => 'App\Models\User',
	            'model_id' => 2,
	        ]);
    	}
    }
}
