<?php

use App\Settings;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $data = [
            [
            'group' => 'company','key'=>'cnss', 'value'=>'1234566','workspace_id'=>1,'type'=>'string',
            'group' => 'company','key'=>'pattente', 'value'=>'1234566','workspace_id'=>1,'type'=>'string',
            'group' => 'company','key'=>'ICE', 'value'=>'1234566','workspace_id'=>1,'type'=>'string',
            'group' => 'company','key'=>'Adress', 'value'=>'1234566','workspace_id'=>1,'type'=>'string',
            'group' => 'company','key'=>'Tele', 'value'=>'1234566','workspace_id'=>1,'type'=>'string',
            'group' => 'company','key'=>'footer', 'value'=>'all fouter identity','workspace_id'=>1, 'type'=>'string',
            ], 
        ];

        foreach ($data as $setting) {
           Settings::create($setting);
        }
    }
}
