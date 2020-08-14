<?php

namespace App\Http\Controllers\Api\Role;

use App\Model\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\Role as RoleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GetRoles extends Controller
{
    public function __invoke(): JsonResource
    {
        $roles = Role::all();

        return RoleResource::collection($roles);
    }
}
