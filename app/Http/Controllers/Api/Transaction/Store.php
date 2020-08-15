<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Model\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\TransactionCart;

class Store extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $transaction = Transaction::create([
            'store_id' => auth()->user()->store_id,
            'staff_id' => auth()->id(),
            'total_price' => $request->total_price,
            'tax' => $request->tax,
            'total_price_with_tax' => $request->total_price_with_tax,
        ]);

        if ($transaction) {
            $this->createTransactionCart($transaction, $request);
            $this->updateCart($request);
        }

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function createTransactionCart(Transaction $transaction, Request $request): void
    {
        foreach ($request->carts as $cart) {
            TransactionCart::create([
                'transaction_id' => $transaction->id,
                'cart_id' => $cart,
            ]);
        }
    }

    public function updateCart(Request $request)
    {
        Cart::whereIn('id', $request->carts)
            ->update(['is_checkedout' => true]);
    }
}
