<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * 画像アップロード
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request) {
        $dir = $request->get('dir');
        $filename = now()->format('YmdHis').rand(1, 9).".".$request->file('img')->extension();
        $path = $request->file('img')->storeAs($dir, $filename, 'public');
        return response()->json(['status' => 'ok', 'path' => Storage::url($path)]);
    }

    /**
     * 画像アップロード (複数)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImages(Request $request) {
        $dir = $request->get('dir');
        $paths = [];
        foreach ($request->file('imgList') as $img) {
            $filename = now()->format('YmdHis').uniqid('', true).".". $img->extension();
            $image = \Image::make($img);
            $image->resize(1200, null,
                function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                }
            );
            $image->orientate();
            $image->save(storage_path(). "/app/public/{$dir}/{$filename}");
            $paths[] = Storage::url("{$dir}/{$filename}");

            // リサイズした画像も保存する
            $resizedImage = \Image::make($img);
            $resizedImage->resize(600, null,
                function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                }
            );
            $resizedImage->orientate();
            $resizedImage->save(storage_path(). "/app/public/{$dir}/resized-{$filename}");
        }
        return response()->json(['status' => 'ok', 'paths' => $paths]);
    }
}
