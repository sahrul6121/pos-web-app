<?php

namespace App\Http\Controllers\Api\Product;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Picture as PictureForm;

class UploadPicture extends Controller
{
    const IMAGE_PATH = 'public/product/picture';

    public function __invoke(PictureForm $request): JsonResponse
    {
        $imageName = auth()->user()->name.Carbon::now()->format('dmY');

        $hashedImageName = Hash::make($imageName);

        $extension = $request->file('picture')->extension();

        $fullImageName = $hashedImageName.'.'.$extension;

        $picture = $request->picture->storeAs(self::IMAGE_PATH, $fullImageName);

        return response()->json([
            'picture_url' => url(Storage::url($picture)),
            'picture_path' => Storage::url($picture),
        ]);
    }
}
