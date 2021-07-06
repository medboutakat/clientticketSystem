<?php

namespace App; 
use Illuminate\Database\Eloquent\Model;
use App\Customer; 
use App\Bank;
use Carbon\Carbon;

class DeliveryDetail extends Model
{
   protected $fillable = ['product_id','product_code','product_name','unit_id', 'price','quantity', 'vat','remise','remise_amount','total','delivery_id','remark'];
      
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    
    public function Delivery()
    {
        return $this->belongsTo('App\Delivery', 'Delivery');
    }
}
