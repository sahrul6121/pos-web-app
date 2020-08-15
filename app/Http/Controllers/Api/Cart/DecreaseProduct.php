<?php

namespace App\Http\Controllers\Api\Cart;

use App\Model\Cart;
use App\Model\Product;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class DecreaseProduct extends Controller
{
    public function __invoke(int $productId): JsonResponse
    {
        if (!$productId) {
            return response()->json([
                'message' => 'id cant be null.',
            ], 422);
        }

        if (! $this->isExist($productId)) {
            return response()->json([
                'message' => 'product not found.',
            ], 422);
        }

        $this->updateCartQuantity($productId);

        return $this->successResponse();
    }

    public function getProduct(int $productId): Product
    {
        return Product::find($productId);
    }

    public function isExist(int $productId): bool
    {
        return Cart::where('product_id', $productId)
            ->where('is_checkedout', false)
            ->exists();
    }

    public function updateCartQuantity(int $productId)
    {
        $cart = Cart::where('product_id', $productId)->first();

        $cart->quantity -= 1;

        $cart->save();

        return $this->successResponse();
    }

    function successResponse(): JsonResponse
    {
        return response()->json([
            'message' => 'success'
        ]);
    }
}
