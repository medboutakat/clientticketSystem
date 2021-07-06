<?php

use Illuminate\Database\Seeder;
use App\DeliveryBankDates;
class DeliveryBankDatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryBankDates = [
            [
             'name' => 'BP/DATE'
            ],
            [
              'name' => 'AWB:ESPACE DATE'
            ],
            [
              'name' => 'BMCE/ESPACE DATE'
            ],
            [
                'name' => 'BMCI/ESPACE DATE'
            ],
            [
                'name' => 'SG/ESPACE DATE'
            ],
            [
                'name' => 'CIH/ESPACE DATE'
            ],
            [
                'name' => 'CDM/ESPACE DATE'
            ],
            [
                'name' => 'CA/ESPACE DATE'
            ],
            [
                'name' => 'AUTRE/ESPACE DATE'
            ]
       ];
    
       foreach ($deliveryBankDates as $deliveryBankDate) {
            DeliveryBankDates::create($deliveryBankDate);
       }
    }
}
