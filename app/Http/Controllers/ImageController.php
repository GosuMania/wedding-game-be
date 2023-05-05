<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        if (!$request->hasFile('image') && !$request->file('image')->isValid()) {
            return response()->json(['error' => 'Perfavore inserisci un immagine.'], 401);
        } else {
            try {
                $image = $request->file('image');
                $path = $image->storePubliclyAs(
                    '', Carbon::now()->timestamp.'.'.$image->getClientOriginalExtension(), 'images'
                );
                Image::create([
                    'link' => env('APP_URL').'/images/'.$path,
                ]);
                return response()->json(env('APP_URL').'/images/'.$path, 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            } catch (Exception $e) {
                return response()->json($e);
            }
        }

    }

    public function uploadVideo(Request $request)
    {
        if (!$request->hasFile('video') && !$request->file('video')->isValid()) {
            return response()->json(['error' => 'Perfavore inserisci un immagine.'], 401);
        } else {
            try {
                $video = $request->file('video');
                $path = $video->storePubliclyAs(
                    '', Carbon::now()->timestamp.'.'.$video->getClientOriginalExtension(), 'videos'
                );
                Image::create([
                    'link' => env('APP_URL').'/videos/'.$path,
                ]);
                return response()->json(env('APP_URL').'/videos/'.$path, 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            } catch (Exception $e) {
                return response()->json($e);
            }
        }

    }
}
