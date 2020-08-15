<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Transaction extends JsonResource
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
            'staff_name' => $this->staff->name,
            'total_price' => 'Rp' . number_format($this->total_price, 0, ',', '.'),
            'total_with_tax' => 'Rp' . number_format($this->total_price_with_tax, 0, ',', '.'),
            'tax' => 'Rp' . number_format($this->tax, 0, ',', '.'),
            'carts' => TransactionCart::collection($this->transactionCarts),
        ];
    }
}
