<?php

use Illuminate\Database\Seeder;
use App\Customer;
class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        // Customer::truncate();

        $faker = \Faker\Factory::create();
 
        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 3; $i++) {
            Customer::create([
                'full_name' =>$faker->name,
                'cin' =>$faker->word,
                'phone' => $faker->e164PhoneNumber ,
                'email' =>$faker->Email, 
                // 'user_id' =>$i+1, 
                'workspace_id' =>1, 
            ]);
        }
    }
    
}
