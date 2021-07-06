<?php

namespace App; 
use App\Bank;
use App\Customer; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Supplier extends BaseModel
{   

    protected $fillable = ['created_user','updated_user','name','city_code','adress','latutude',"langitude","remark","image_url","category_id"];
  
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ]; 
} 