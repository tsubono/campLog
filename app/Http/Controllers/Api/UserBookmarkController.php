<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserBookmarkRequest;
use App\Http\Requests\Api\UserBookmarkStoreRequest;
use App\Http\Requests\Api\UserBookmarkUpdateRequest;
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $userBookmarks = $this->userBookmarkRepository->getListByUserId(
            $request->user()->id,
            $request->offset ?? 0,
            $request->limit ?? 10,
            $request->is_all
        );

        return response()->json([
            'code' => 200,
            'userBookmarks' => $userBookmarks,
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * ブックマーク登録
     *
     * @param UserBookmarkStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserBookmarkStoreRequest $request)
    {
        try {
            $userBookmarks = $this->userBookmarkRepository->getByCondition(['user_id' => $request->user()->id]);
            $userBookmark = $this->userBookmarkRepository->store($request->all() + [
                'user_id' => $request->user()->id,
                'sort' => count($userBookmarks) + 1,
            ]);

            return response()->json(['code' => 200, 'userBookmark' => $userBookmark], 200, [], JSON_PRETTY_PRINT);

        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'error_message' => $e->getMessage(),
            ], 500, [], JSON_PRETTY_PRINT);
        }
    }

    /**
     * ブックマーク更新
     *
     * @param int $id
     * @param UserBookmarkUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $id, UserBookmarkUpdateRequest $request)
    {
        try {
            $userBookmark = $this->userBookmarkRepository->update($id, $request->except(['id', 'user_id']));

            return response()->json(['code' => 200, 'userBookmark' => $userBookmark], 200, [], JSON_PRETTY_PRINT);

        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'error_message' => $e->getMessage(),
            ], 500, [], JSON_PRETTY_PRINT);
        }
    }

    /**
     * ブックマーク並び順更新
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateSort(Request $request)
    {
        try {
            $this->userBookmarkRepository->updateSort(json_decode($request->get('bookmarks')));

            return response()->json(['code' => 200], 200, [], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'error_message' => $e->getMessage(),
            ], 500, [], JSON_PRETTY_PRINT);
        }
    }

    /**
     * ブックマーク削除
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $this->userBookmarkRepository->destroy($id);

            return response()->json(['code' => 200], 200, [], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'error_message' => $e->getMessage(),
            ], 500, [], JSON_PRETTY_PRINT);
        }
    }
}