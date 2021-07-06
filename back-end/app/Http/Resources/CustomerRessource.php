<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerRessource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'rib' => $this->rib,
            'bank_account_no' => $this->bank_account_no,
            'cin' => $this->cin,
            'bank_name' => $this->bank_name,
            // 'CheckBanks' => $this->CheckBanks(), 
        ]; 
    }
}
