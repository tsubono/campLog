<?php

namespace App\Http\Controllers;

use App\Models\CampSchedule;
use App\Repositories\CampSchedule\CampScheduleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class CampScheduleController extends Controller
{
    private UserRepositoryInterface $userRepository;
    private CampScheduleRepositoryInterface $campScheduleRepository;

    /**
     * ProfileController constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param CampScheduleRepositoryInterface $campScheduleRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, CampScheduleRepositoryInterface $campScheduleRepository)
    {
        $this->userRepository = $userRepository;
        $this->campScheduleRepository = $campScheduleRepository;
    }

    /**
     * キャンプ記録詳細
     *
     * @param CampSchedule $campSchedule
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(CampSchedule $campSchedule)
    {
        if (!$campSchedule->is_public) {
            abort(404);
        }

        return view('camp-schedules.show', compact('campSchedule'));
    }
}
