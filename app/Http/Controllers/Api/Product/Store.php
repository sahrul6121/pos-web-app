<?php

namespace App\Http\Controllers\Api\Product;

use App\Model\Product;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product as ProductForm;

class Store extends Controller
{
    public function __invoke(ProductForm $request): JsonResponse
    {
        Product::create([
            'category_id' => 1, // just dummy data
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $request->picture,
            'discount_percentage' => $request->discount_percentage,
            'is_available' => $request->status,
            'store_id' => auth()->user()->store_id,
            'creator_id' => auth()->id(),
        ]);

        return response()->json([
            'message' => 'success'
        ]);
    }
}
