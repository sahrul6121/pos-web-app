<?php

namespace App\Http\Controllers\Api\Cart;

use App\Model\Cart;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class RemoveProduct extends Controller
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

        Cart::where('product_id', $productId)
            ->where('is_checkedout', false)
            ->delete();

        return $this->successResponse();
    }

    public function isExist(int $productId): bool
    {
        return Cart::where('product_id', $productId)
            ->where('is_checkedout', false)
            ->exists();
    }

    function successResponse(): JsonResponse
    {
        return response()->json([
            'message' => 'success'
        ]);
    }
}
