<?php

namespace App; 
use App\Bank;
use App\Customer; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Products extends BaseModel
{   

    protected $fillable = ['name','price','display_name','description',"category_id","tags","image_url",'created_user','updated_user'];
       
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ]; 
} 
 