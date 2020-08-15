<?php

namespace App\Http\Controllers\Api\Cart;

use App\Model\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\Cart as CartResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Index extends Controller
{
    public function __invoke()
    {
        $carts = Cart::query()
            ->with('product')
            ->where('is_checkedout', false)
            ->where('staff_id', auth()->id());

        $carts = $this->filter($carts);

        return CartResource::collection($carts);
    }

    public function filter(Builder $carts): LengthAwarePaginator
    {
        return $carts->paginate(10);
    }
}
