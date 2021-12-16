<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CampScheduleStoreRequest;
use App\Http\Requests\Api\CampScheduleUpdateRequest;
use App\Repositories\CampSchedule\CampScheduleRepositoryInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        if ($request->user() instanceof MustVerifyEmail && !$request->user()->hasVerifiedEmail()) {
            return response()->json(['code' => 403, 'error_message' => 'メール認証が完了していません'], 403, [], JSON_PRETTY_PRINT);
        }

        $campSchedules = $this->campScheduleRepository->getListByUserId(
            $request->user()->id,
            $request->offset ?? 0,
            $request->limit ?? 10,
            $request->is_all
        );

        return response()->json([
            'code' => 200,
            'campSchedules' => $campSchedules,
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
        if ($request->user() instanceof MustVerifyEmail && !$request->user()->hasVerifiedEmail()) {
            return response()->json(['code' => 403, 'error_message' => 'メール認証が完了していません'], 403, [], JSON_PRETTY_PRINT);
        }

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
        if ($request->user() instanceof MustVerifyEmail && !$request->user()->hasVerifiedEmail()) {
            return response()->json(['code' => 403, 'error_message' => 'メール認証が完了していません'], 403, [], JSON_PRETTY_PRINT);
        }

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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id, Request $request)
    {
        if ($request->user() instanceof MustVerifyEmail && !$request->user()->hasVerifiedEmail()) {
            return response()->json(['code' => 403, 'error_message' => 'メール認証が完了していません'], 403, [], JSON_PRETTY_PRINT);
        }

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
