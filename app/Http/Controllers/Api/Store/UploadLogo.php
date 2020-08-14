<?php

namespace App\Http\Controllers\Api\Store;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Logo as LogoForm;

class UploadLogo extends Controller
{
    const IMAGE_PATH = 'public/logo';

    public function __invoke(LogoForm $request): JsonResponse
    {
        $imageName = auth()->user()->name.Carbon::now()->format('dmY');

        $hashedImageName = hash('sha256', $imageName);

        $extension = $request->file('logo')->extension();

        $fullImageName = $hashedImageName.'.'.$extension;

        $logo = $request->logo->storeAs(self::IMAGE_PATH, $fullImageName);

        return response()->json([
            'logo_url' => url(Storage::url($logo)),
            'logo_path' => Storage::url($logo),
        ]);
    }
}
