<?php

namespace App\Http\Controllers\Api\Role;

use App\Model\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\Role as RoleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GetRoles extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(): JsonResource
    {
        $roles = Role::when(auth()->user()->role->slug == 'super-admin', function ($role) {
            return $role->whereNotIn('slug', ['super-admin', 'staff']);
        })
        ->when(auth()->user()->role->slug == 'admin', function ($role) {
            return $role->whereNotIn('slug', ['admin', 'super-admin']);
        })
        ->get();

        return RoleResource::collection($roles);
    }
}
