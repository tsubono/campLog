<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccessCodeRequest;
use App\Repositories\AccessCode\AccessCodeRepositoryInterface;

class AccessCodeController extends Controller
{
    private AccessCodeRepositoryInterface $accessCodeRepository;

    /**
     * AccessCodeController constructor.
     *
     * @param AccessCodeRepositoryInterface $accessCodeRepository
     */
    public function __construct(AccessCodeRepositoryInterface $accessCodeRepository)
    {
        $this->accessCodeRepository = $accessCodeRepository;
    }

    /**
     * 認証コード入力画面
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('access-code');
    }

    /**
     * アクセスコード確認
     *
     * @param AccessCodeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function check(AccessCodeRequest $request)
    {
        $accessCode = $this->accessCodeRepository->find();
        if ($accessCode->code === $request->get('code')) {
            \Cookie::queue('isCheckedAccessCode', true, time() + (10 * 365 * 24 * 60 * 60));
            return redirect(route('login'));
        }

        return redirect(route('access-code.index'))->with('error-message', '認証コードが正しくありません');
    }
}
