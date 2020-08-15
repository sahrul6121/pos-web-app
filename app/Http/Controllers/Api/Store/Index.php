<?php

namespace App\Http\Controllers\Api\Store;

use App\Model\Store;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\Store as StoreResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Index extends Controller
{
    public function __invoke()
    {
        $stores = Store::query()
            ->with('owner', 'products');

        $stores = $this->filter($stores);

        return StoreResource::collection($stores);
    }

    public function filter(Builder $stores): LengthAwarePaginator
    {
        return $stores->paginate(10);
    }
}
