<?php

use Illuminate\Database\Seeder;
use App\EncasmentMode;
class EncasmentModeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $encasmentModes = [
        [
            'name' => 'ESPECE/DATE'
        ],
        [
          'name' => 'CHEQUE/DATE'
        ],
        [
          'name' => 'EFFET/DATE'
        ],
        [
          'name' => 'VIREMENT/DATE'
        ],
        [
          'name' => 'VERSEMENT/DATE'
        ] 
   ];

   foreach ($encasmentModes as $encasmentMode) {
    EncasmentMode::create($encasmentMode);
   }

    }
}
