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
            $filename = now()->format('YmdHis').rand(1, 9).".". $img->extension();
            $paths[] = Storage::url($img->storeAs($dir, $filename, 'public'));

            // リサイズした画像も保存する
            $image = \Image::make($img);
            $image->orientate();
            $image->resize(600, null,
                function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                }
            );
            $image->save(storage_path(). "/app/public/{$dir}/resized-{$filename}");
        }
        return response()->json(['status' => 'ok', 'paths' => $paths]);
    }
}
