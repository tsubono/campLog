<?php

namespace App\Http\Controllers;

use App\Models\CampPlace;
use App\Models\User;
use App\Repositories\CampPlace\CampPlaceRepositoryInterface;
use App\Repositories\CampSchedule\CampScheduleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class CampPlaceController extends Controller
{
    private CampPlaceRepositoryInterface $campPlaceRepository;

    /**
     * CampPlaceController constructor.
     *
     * @param CampPlaceRepositoryInterface $campPlaceRepository
     */
    public function __construct(
        CampPlaceRepositoryInterface $campPlaceRepository
    )
    {
        $this->campPlaceRepository = $campPlaceRepository;
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
     * @return \Illuminate\Contracts\View\View
     */
    public function show(CampPlace $campPlace)
    {
        return view('camp-places.show', compact('campPlace'));
    }
}