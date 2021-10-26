<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\CampPlace\CampPlaceRepositoryInterface;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $campPlaces = $this->campPlaceRepository->getList($request->offset ?? 0, $request->limit ?? 10, $request->is_all, $request->keyword);

        return response()->json([
            'code' => 200,
            'campPlaces' => $campPlaces,
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $campPlace = $this->campPlaceRepository->getOne($request->id);

        return response()->json([
            'code' => 200,
            'campPlace' => $campPlace,
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
