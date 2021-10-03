<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CampPlace;
use App\Repositories\UserBookmark\UserBookmarkRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserBookmarkController extends Controller
{
    private UserBookmarkRepositoryInterface $userBookmarkRepository;

    /**
     * CampPlaceController constructor.
     *
     * @param UserBookmarkRepositoryInterface $userBookmarkRepository
     */
    public function __construct(
        UserBookmarkRepositoryInterface $userBookmarkRepository
    )
    {
        $this->userBookmarkRepository = $userBookmarkRepository;
    }

    /**
     * ブックマーク更新
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $this->userBookmarkRepository->update($request->id, $request->all());

        return response()->json(['status' => 'ok']);
    }

    /**
     * ブックマーク並び順更新
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateSort(Request $request)
    {
        $this->userBookmarkRepository->updateSort(json_decode($request->get('bookmarks')));

        return response()->json(['status' => 'ok']);
    }

    /**
     * ブックマーク削除
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $this->userBookmarkRepository->destroy($request->id);

        return response()->json(['status' => 'ok']);
    }
}