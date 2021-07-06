<?php

use Illuminate\Database\Seeder;
use App\CheckBank;
class CheckBankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $checkBanks = [
            [
                'workspace_id'=>1,
                'check_number' => '123',
                'payment_deadline_date' => '10/10/20',
                'report_date' => null,
                'encasment_date' => '10/10/20',
                'unpaid_date' => '10/10/20',
                'reception_date' => '10/10/20',
                'amount' => '2000',
                'customer_id' => '1', 
                'customer_name' => 'med',
                'payer_id' => '1', 
                'payer_name' => 'mohamed',
                'nature_checks_id' => '1',
                'delivery_bank_dates_id' => '1',
                'bank_id' => '1', 
                'delivery_bank_id' => '1',
                'encasment_modes_id' => '1',  
                'created_user'=>'med',
                'updated_user'=>'med', 
                'payment_modes_id'=>1
            ],
            [
                'workspace_id'=>1,
                'check_number' => '123',
                'payment_deadline_date' => '10/10/20',
                'report_date' => null,
                'encasment_date' => '10/10/20',
                'unpaid_date' => '10/10/20',
                'reception_date' => '10/10/20',
                'amount' => '2000',
                'customer_id' => '1',  
                'customer_name' => 'med',
                'payer_id' => '1', 
                'payer_name' => 'mohamed',
                'nature_checks_id' => '1',
                'delivery_bank_dates_id' => '1',
                'bank_id' => '1',  
                'delivery_bank_id' => '1',
                'encasment_modes_id' => '1', 
                'created_user'=>'med',
                'updated_user'=>'med', 
                'payment_modes_id'=>1
            ], 
           
       ];
    
       foreach ($checkBanks as $checkBank) {
        CheckBank::create($checkBank);
       } 
 
    }
}