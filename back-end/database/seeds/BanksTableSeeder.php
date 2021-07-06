<?php

use Illuminate\Database\Seeder;
use App\Bank;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $banks = [
            [
                'name' => 'Attijariwafa Bank',
                'swift' => 'AWB'
            ],
            [
                'name' => 'Banque Populaire',
                'swift' => 'BPM'
            ],
            [
                'name' => 'bmci bank',
                'swift' => 'BMCI'
            ],
            [
                'name' => 'Societe Generale',
                'swift' => 'SGM' 
            ],
            [
                'name' => 'BMCE',
                'swift' => 'BMCE' 
            ],
            [
                'name' => 'Credit Agricole',
                'swift' => 'CAM' 
            ],
            [
                'name' => 'Credit du Maroc',
                'swift' => 'CM' 
            ],
            [
                'name' => 'CIH Bank',
                'swift' => 'CIH' 
            ] ,
            [
                'name' => '-----',
                'swift' => ' Autre' 
            ]                
       ];

       foreach ($banks as $bank) {
          Bank::create($bank);
       }

 
    }
}
