<?php

namespace App\Http\Controllers\Api\Cart;

use App\Model\Cart;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartDetails as CartDetailsResource;

class Details extends Controller
{
    public function __invoke()
    {
        $carts = Cart::first();

        return new CartDetailsResource($carts);
    }
}
