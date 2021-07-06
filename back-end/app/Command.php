<?php

namespace App; 
use Illuminate\Database\Eloquent\Model;
use App\Customer; 
use App\Bank;
use Carbon\Carbon;

class Command extends BaseModel
{
    protected $fillable = ['code','deposit_id','customer_id', 'date','remise','subtotal','total','delivery_status_id','invoice_id' ];
     
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    public function DeliveryDetails()
    {
        return $this->hasMany('App\DeliveryDetail');
    }
}
