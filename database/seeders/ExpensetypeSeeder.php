<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expensetype;

class ExpensetypeSeeder extends Seeder
{
    
    public function run()
    {
        Expensetype::create([
        	'name' => 'Salary',
	    ]);

	    Expensetype::create([
        	'name' => 'Transport',
	    ]);

	    Expensetype::create([
        	'name' => 'Maintance',
	    ]);

	    Expensetype::create([
        	'name' => 'Purchase',
	    ]);

	    Expensetype::create([
        	'name' => 'Electronic Charges',
	    ]);

	    Expensetype::create([
        	'name' => 'Internet Bill',
	    ]);
    }
}
