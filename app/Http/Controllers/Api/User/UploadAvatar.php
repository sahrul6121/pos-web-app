<?php

namespace App\Http\Controllers\Api\User;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Avatar as AvatarForm;

class UploadAvatar extends Controller
{
    const IMAGE_PATH = 'public/avatar';

    public function __invoke(AvatarForm $request): JsonResponse
    {
        $imageName = auth()->user()->name.Carbon::now()->format('dmY');

        $hashedImageName = Hash::make($imageName);

        $extension = $request->file('avatar')->extension();

        $fullImageName = $hashedImageName.'.'.$extension;

        $avatar = $request->avatar->storeAs(self::IMAGE_PATH, $fullImageName);

        return response()->json([
            'avatar_url' => url(Storage::url($avatar)),
            'avatar_path' => Storage::url($avatar),
        ]);
    }
}
