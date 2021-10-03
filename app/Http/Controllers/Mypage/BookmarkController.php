<?php

namespace App\Http\Controllers\Mypage;

use App\Http\Controllers\Controller;
use App\Repositories\UserBookmark\UserBookmarkRepositoryInterface;

class BookmarkController extends Controller
{
    private UserBookmarkRepositoryInterface $userBookmarkRepository;

    /**
     * BookmarkController constructor.
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
     * ブックマーク一覧
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $bookmarks = $this->userBookmarkRepository->getByCondition([
            'user_id' => auth()->user()->id,
        ]);

        return view('mypage.bookmarks.index', compact('bookmarks'));
    }
}