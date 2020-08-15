<?php

namespace App\Http\Controllers\Api\Product;

use App\Model\Product;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\Product as ProductResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Index extends Controller
{
    public function __invoke()
    {
        $products = Product::query()
            ->when(auth()->user()->store_id, function ($product, $storeId) {
                return $product->where('store_id', $storeId);
            })
            ->when(auth()->user()->store, function ($product, $store) {
                return $product->where('store_id', $store->id);
            });

        $products = $this->filter($products);

        return ProductResource::collection($products);
    }

    public function filter(Builder $products): LengthAwarePaginator
    {
        return $products->paginate(10);
    }
}
