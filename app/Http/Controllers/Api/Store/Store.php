<?php

namespace App\Http\Controllers\Api\Store;

use Illuminate\Http\JsonResponse;
use App\Model\Store as ModelStore;
use App\Http\Controllers\Controller;
use App\Http\Requests\Store as StoreForm;

class Store extends Controller
{
    public function __invoke(StoreForm $request): JsonResponse
    {
        ModelStore::create([
            'admin_id' => $request->admin_id,
            'name' => $request->name,
            'logo' => $request->logo,
            'address' => $request->address,
        ]);

        return response()->json([
            'message' => 'success'
        ]);
    }
}
