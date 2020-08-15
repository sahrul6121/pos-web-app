<?php

namespace App\Services;

trait PriceDetails
{
    public function getTotalPriceAttribute(): int
    {
        $carts = $this->where('staff_id', auth()->id())
            ->where('is_checkedout', false)
            ->get();

        $totalPrice = 0;

        foreach ($carts as $cart) {
            $total = $cart->price * $cart->quantity;

            $totalPrice += $total;
        }

        return $totalPrice;
    }

    public function getTaxAttribute(): int
    {
        return $this->totalPrice * 2 / 100;
    }

    public function getTotalPriceWithTaxAttribute(): int
    {
        return $this->totalPrice + $this->tax;
    }
}
