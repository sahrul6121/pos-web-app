<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionCart extends JsonResource
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
            'id' => $this->cart->id,
            'product_id' => $this->cart->product_id,
            'product_image' => $this->cart->product->image,
            'product_name' => $this->cart->product->name,
            'product_price' => 'Rp' . number_format($this->cart->price, 0, ',', '.'),
            'quantity' => $this->cart->quantity,
            'store_name' => $this->cart->product->store->name,
            'ordered_at' => Carbon::parse($this->cart->created_at)->isoFormat('MMM Do YY'),
        ];
    }
}
