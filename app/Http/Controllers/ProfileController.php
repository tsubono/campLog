<?php

namespace App\Http\Controllers;

use App\Repositories\User\UserRepositoryInterface;

class ProfileController extends Controller
{
    private UserRepositoryInterface $userRepository;

    /**
     * ProfileController constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
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
        if (auth()->check() && $user->id !== auth()->user()->id) {
            $this->userRepository->update($user->id, ['access_count' => $user->access_count + 1]);
        }

        return view('profile', compact('user'));
    }
}
