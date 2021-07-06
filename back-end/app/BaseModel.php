<?php

namespace App;  
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
   

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];


    public static function boot()
    {
        parent::boot();
       
        static::creating(function ($model) {  
            $user = Auth::user();
            $model->created_user="1";
            $model->updated_user="1";
            if ($user) {
                $model->created_user = $user->id;
                $model->updated_user = $user->id;
            }
        });
        
        static::updating(function ($model) { 
            $user = Auth::user();
            if ($user) { 
                $model->updated_user = $user->id;
            }
        });  
    }    
}
