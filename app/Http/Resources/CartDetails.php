<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CartDetails extends JsonResource
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
            'total_price_formatted' => 'Rp' . number_format($this->totalPrice, 0, ',', '.'),
            'total_price_with_tax_formatted' => 'Rp' . number_format($this->totalPriceWithTax, 0, ',', '.'),
            'tax_formatted' => 'Rp' . number_format($this->tax, 0, ',', '.'),
            'total_price' => $this->totalPrice,
            'total_price_with_tax' => $this->totalPriceWithTax,
            'tax' => $this->tax,
        ];
    }
}
