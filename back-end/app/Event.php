<?php

namespace App; 
use Illuminate\Database\Eloquent\Model;
use App\Customer; 
use App\Bank;
use Carbon\Carbon;

class Event extends Model
{
    protected $fillable = ['code', 'name','key',"table"];

     
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

}
