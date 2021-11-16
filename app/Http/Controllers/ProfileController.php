<?php

namespace App\Http\Controllers;

use App\Repositories\CampSchedule\CampScheduleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class ProfileController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(string $userName)
    {
        $user = $this->userRepository->getByUserName($userName);
        if (empty($user)) {
            abort(404);
        }

        // 自身のプロフィールでない場合はアクセス数を更新する
        if (!auth()->check() || (auth()->check() && $user->id !== auth()->user()->id)) {
            $this->userRepository->update($user->id, ['access_count' => $user->access_count + 1]);
        }

        $campSchedules = $this->campScheduleRepository->getPaginateByUserId($user->id);

        return view('profile', compact('user', 'campSchedules'));
    }
}
