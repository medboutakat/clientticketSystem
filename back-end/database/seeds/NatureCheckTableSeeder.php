<?php

use Illuminate\Database\Seeder;
use App\NatureCheck;
class NatureCheckTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $natureChecks = [
            [
            'name' => 'NORMALE'
            ],
            [
              'name' => 'GARANTIE'
            ],
            [
              'name' => 'EFFET/DATE'
            ],
            [
              'name' => 'A ECHANGER'
            ]
        ];

        foreach ($natureChecks as $natureCheck) {
           NatureCheck::create($natureCheck);
        }
    }
}
