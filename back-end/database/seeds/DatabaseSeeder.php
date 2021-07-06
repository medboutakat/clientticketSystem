<?php

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

        $this->call([ 
            // WorkspaceTableSeeder::class,
            // UsersTableSeeder::class,
            // BanksTableSeeder::class,
            // CustomersTableSeeder::class,
            // NatureCheckTableSeeder::class,
            // DeliveryBankDatesTableSeeder::class,  
            // EncasmentModeTableSeeder::class,
            // PaymentModeTableSeeder::class,
            // CheckBankTableSeeder::class,    
            // CheckBankOutTableSeeder::class     
        ]);
 
    }
}
