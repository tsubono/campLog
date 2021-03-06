<?php

namespace App\Http\Controllers\Mypage;

use App\Http\Requests\UserRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ProfileController extends Controller
{
    private UserRepositoryInterface $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * プロフィール設定
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('mypage.profile.edit', ['user' => auth()->user()]);
    }

    /**
     * プロフィール更新
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request)
    {
        $data = $request->all();
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }
        $data['camp_start_date'] =
            !empty($data['camp_start_date_y']) && !empty($data['camp_start_date_m']) ? Carbon::parse("{$data['camp_start_date_y']}-{$data['camp_start_date_m']}-1") : null;
            $this->userRepository->update(auth()->user()->id, $data);

        return redirect(route('mypage.profile.edit'))->with('message', '更新しました');
    }

    /**
     * プロフィール削除
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        $this->userRepository->destroy(auth()->user()->id);

        return redirect(url('/'));
    }
}
