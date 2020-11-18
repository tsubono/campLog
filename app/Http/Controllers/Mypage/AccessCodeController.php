<?php

namespace App\Http\Controllers\Mypage;

use App\Models\AccessCode;
use App\Repositories\AccessCode\AccessCodeRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
     * アクセスコード設定画面
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 管理者チェック
        if (!auth()->user()->admin_flg) {
            abort(404);
        }
        $accessCode = $this->accessCodeRepository->find();

        return view('mypage.access-code.index', compact('accessCode'));
    }

    /**
     * アクセスコード設定更新
     *
     * @param AccessCode $accessCode
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AccessCode $accessCode, Request $request)
    {
        // 管理者チェック
        if (!auth()->user()->admin_flg) {
            abort(404);
        }

        $data = $request->all();
        if (!empty($data['updateCode'])) {
            $data['code'] = uniqid('', true);
        }
        $this->accessCodeRepository->update($accessCode->id, $data);

        return redirect(route('mypage.access-code.index'))->with('message', '更新しました');
    }
}
