<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Cart extends JsonResource
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
            'product_id' => $this->product_id,
            'product_image' => $this->product->image,
            'product_name' => $this->product->name,
            'product_price' => 'Rp' . number_format($this->price, 0, ',', '.'),
            'quantity' => $this->quantity,
            'store_name' => $this->product->store->name,
            'ordered_at' => Carbon::parse($this->created_at)->isoFormat('MMM Do YY'),
        ];
    }
}
