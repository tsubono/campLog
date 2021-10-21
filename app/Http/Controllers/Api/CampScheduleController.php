<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CampScheduleRequest;
use App\Http\Requests\Api\CampScheduleStoreRequest;
use App\Http\Requests\Api\CampScheduleUpdateRequest;
use App\Repositories\CampSchedule\CampScheduleRepositoryInterface;
use Illuminate\Http\Request;

class CampScheduleController extends Controller
{
    private CampScheduleRepositoryInterface $campScheduleRepository;

    /**
     * CampScheduleController constructor.
     *
     * @param CampScheduleRepositoryInterface $campScheduleRepository
     */
    public function __construct(
        CampScheduleRepositoryInterface $campScheduleRepository
    )
    {
        $this->campScheduleRepository = $campScheduleRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(Request $request)
    {
        $campPlaces = $this->campScheduleRepository->getListByUserId(
            $request->user()->id,
            $request->offset ?? 0,
            $request->limit ?? 10,
            $request->is_all
        );

        return response()->json([
            'code' => 200,
            'campPlaces' => $campPlaces,
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(int $id)
    {
        $campSchedule = $this->campScheduleRepository->getOne($id);

        return response()->json([
            'code' => 200,
            'campSchedule' => $campSchedule,
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * @param CampScheduleStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CampScheduleStoreRequest $request)
    {
        try {
            $campSchedule = $this->campScheduleRepository->store($request->all() + ['user_id' => $request->user()->id]);

            return response()->json([
                'code' => 200,
                'campSchedule' => $campSchedule,
            ], 200, [], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'error_message' => $e->getMessage(),
            ], 500, [], JSON_PRETTY_PRINT);
        }
    }

    /**
     * @param int $id
     * @param CampScheduleUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $id, CampScheduleUpdateRequest $request)
    {
        try {
            $campSchedule = $this->campScheduleRepository->update($id, $request->except(['user_id']));

            return response()->json([
                'code' => 200,
                'campSchedule' => $campSchedule,
            ], 200, [], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'error_message' => $e->getMessage(),
            ], 500, [], JSON_PRETTY_PRINT);
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $this->campScheduleRepository->destroy($id);

            return response()->json([
                'code' => 200,
            ], 200, [], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'error_message' => $e->getMessage(),
            ], 500, [], JSON_PRETTY_PRINT);
        }
    }
}
