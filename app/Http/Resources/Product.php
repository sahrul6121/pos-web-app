<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            'store_id' => $this->store_id,
            'creator_id' => $this->creator_id,
            'creator_name' => $this->creator->name,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'image' => $this->image,
            'price' => 'Rp' . number_format($this->price, 0, ',', '.'),
            'stock' => $this->stock,
            'discount_percentage' => $this->discount_percentage,
            'is_available' => $this->is_available,
        ];
    }
}
