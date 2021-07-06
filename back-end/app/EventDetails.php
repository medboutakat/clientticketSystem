<?php

namespace App; 
use Illuminate\Database\Eloquent\Model;
use App\Customer; 
use App\Bank;
use Carbon\Carbon;

class EventDetails extends Model
{
    protected $fillable = ['key','original', 'changes','event_id '];

     
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

}
