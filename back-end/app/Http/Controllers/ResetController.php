<?php

namespace App\Http\Controllers;

use App\Picture;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\DB;
 

class ResetController extends Controller
{
    public function reset()
    { 

        //  DB::statement("Delete FROM check_banks");
        //  DB::statement("Delete FROM check_states");
        //  DB::statement("Delete FROM transfers");
        //  DB::statement("Delete FROM bank_accounts");
        //  DB::statement("Delete FROM customers");
        //  DB::statement("Delete FROM users");
        
        //  DB::statement("Delete FROM workspaces"); 
        //  DB::statement("INSERT INTO workspaces (id,NAME,domain,email,logo,created_at,updated_at) 
        //  VALUES (1,'med','@gmsoft.com','med@gmsoft.com',NULL,'2020-11-22 17:14:49','2020-11-22 17:14:49');");

         $hashPasword="\$2y$10\$uwV9EjUw0BWAg/iFw0LSeuwLN5MwkV8CVJpWmdWIQWxwRUsJrNQsy";

         DB::statement("INSERT INTO users (id,NAME,username,workspace_id,email,email_verified_at,activated_at,PASSWORD,role,remember_token,created_at,updated_at)
         VALUES (1, 'admin1','admin1',1,'admin1@gmail.com','2020-11-22 17:14:49','2020-11-22 17:14:49','$hashPasword','admin',NULL,'2020-11-22 17:14:49','2020-11-22 17:14:49')");


         return response()->json('Database rested', 201); 
    } 
}