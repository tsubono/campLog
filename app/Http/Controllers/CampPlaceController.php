<?php

namespace App\Http\Controllers;

use App\Models\CampPlace;
use App\Repositories\CampPlace\CampPlaceRepositoryInterface;
use App\Repositories\UserBookmark\UserBookmarkRepositoryInterface;

class CampPlaceController extends Controller
{
    private CampPlaceRepositoryInterface $campPlaceRepository;
    private UserBookmarkRepositoryInterface $userBookmarkRepository;

    /**
     * CampPlaceController constructor.
     *
     * @param CampPlaceRepositoryInterface $campPlaceRepository
     * @param UserBookmarkRepositoryInterface $userBookmarkRepository
     */
    public function __construct(
        CampPlaceRepositoryInterface $campPlaceRepository,
        UserBookmarkRepositoryInterface $userBookmarkRepository
    )
    {
        $this->campPlaceRepository = $campPlaceRepository;
        $this->userBookmarkRepository = $userBookmarkRepository;
    }

    /**
     * キャンプ場検索
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $campPlaces = $this->campPlaceRepository->getAll();

        return view('camp-places.index', compact('campPlaces'));
    }

    /**
     * キャンプ場詳細
     *
     * @param CampPlace $campPlace
     * @return \Illuminate\Contracts\View\View
     */
    public function show(CampPlace $campPlace)
    {
        $isBookmark = false;
        if (auth()->check()) {
            $userBookmark = $this->userBookmarkRepository->findByCondition([
                'user_id' => auth()->user()->id,
                'camp_place_id' => $campPlace->id
            ]);
            $isBookmark = !empty($userBookmark);
        }
        return view('camp-places.show', compact('campPlace', 'isBookmark'));
    }

    /**
     * キャンプ場ブックマーク保存
     *
     * @param CampPlace $campPlace
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addBookmark(CampPlace $campPlace)
    {
        $userBookmarks = $this->userBookmarkRepository->getByCondition(['user_id' => auth()->user()->id]);
        $this->userBookmarkRepository->store([
            'user_id' => auth()->user()->id,
            'camp_place_id' => $campPlace->id,
            'sort' => count($userBookmarks) + 1,
        ]);

        return redirect(route('camp-places.show', compact('campPlace')))->with('message', 'キャンプ場を保存しました');
    }

    /**
     * キャンプ場ブックマーク保存解除
     *
     * @param CampPlace $campPlace
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function removeBookmark(CampPlace $campPlace)
    {
        $userBookmark = $this->userBookmarkRepository->findByCondition([
            'user_id' => auth()->user()->id,
            'camp_place_id' => $campPlace->id
        ]);
        if (!empty($userBookmark)) {
            $this->userBookmarkRepository->destroy($userBookmark->id);
        }

        return redirect(route('camp-places.show', compact('campPlace')))->with('message', 'キャンプ場の保存を解除しました');
    }
}