<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Model\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\Transaction as TransactionResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Index extends Controller
{
    public function __invoke()
    {
        $transactions = Transaction::query()
            ->when(auth()->user()->role->slug == 'admin', function ($transactions) {
                return $transactions->where('store_id', auth()->user()->store->id);
            })
            ->when(auth()->user()->role->slug == 'staff', function ($transactions) {
                return $transactions->where('staff_id', auth()->id());
            });

        $transactions = $this->filter($transactions);

        return TransactionResource::collection($transactions);
    }

    public function filter(Builder $transactions): LengthAwarePaginator
    {
        return $transactions->paginate(10);
    }
}
