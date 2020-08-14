<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Avatar as AvatarForm;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class UploadAvatar extends Controller
{
    const IMAGE_PATH = 'public/avatar';

    public function __invoke(AvatarForm $request): JsonResponse
    {
        $imageName = auth()->user()->name.Carbon::now()->format('dmY');

        $hashedImageName = hash('sha256', $imageName);

        $extension = $request->file('avatar')->extension();

        $fullImageName = $hashedImageName.'.'.$extension;

        $avatar = $request->avatar->storeAs(self::IMAGE_PATH, $fullImageName);

        return response()->json([
            'avatar_url' => url(Storage::url($avatar)),
            'avatar_path' => Storage::url($avatar),
        ]);
    }
}
