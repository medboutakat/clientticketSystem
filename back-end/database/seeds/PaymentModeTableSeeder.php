<?php

use Illuminate\Database\Seeder;
use App\PaymentMode;
class PaymentModeTableSeeder extends Seeder
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
          'name' => 'CHEQUE'
        ],
        [
          'name' => 'EFFET'
        ]
      ];

      foreach ($encasmentModes as $encasmentMode) {
        PaymentMode::create($encasmentMode);
      }

    }
}
