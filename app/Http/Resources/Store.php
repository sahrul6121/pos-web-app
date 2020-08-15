<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Store extends JsonResource
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
            'owner_name' => $this->owner->name,
            'logo' => $this->logo,
            'income' => 'Rp. 1.000.000',
            'product_count' => count($this->products),
        ];
    }
}
