<?php

use Illuminate\Database\Seeder;

class CustomersTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) { 
	    	customers::create([
	            'name' => str_random(8),
	            'email' => str_random(12).'@mail.com',
	            'available_balance' => rand(10,1000),
                'total_transfer_amount' => "0",
	        ]);
    	}
    }
}
