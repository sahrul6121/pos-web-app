<?php

namespace App\Http\Controllers\Api\User\Staff;

use App\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\User as UserResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Index extends Controller
{
    public function __invoke()
    {
        $users = User::query()
            ->where('store_id', auth()->user()->store->id);

        $users = $this->filter($users);

        return UserResource::collection($users);
    }

    public function filter(Builder $users): LengthAwarePaginator
    {
        return $users->paginate(10);
    }
}
