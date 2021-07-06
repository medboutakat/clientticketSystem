<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        return [ 
            'name' => $this->name,
            'email' => $this->email,  
            'username' => $this->username,  
            'password' => "",  
        ];
        // return parent::toArray($request);
    }

     /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'user';
} 