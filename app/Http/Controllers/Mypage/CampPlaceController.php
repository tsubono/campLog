<?php

namespace App\Http\Controllers\Mypage;

use App\Http\Requests\CampPlaceImportRequest;
use App\Mail\ShippedMail;
use App\Repositories\CampPlace\CampPlaceRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Services\CampPlaceService;
use App\Services\FileService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class CampPlaceController extends Controller
{
    private CampPlaceRepositoryInterface $campPlaceRepository;
    private CampPlaceService $campPlaceService;

    /**
     * CampPlaceController constructor.
     *
     * @param CampPlaceRepositoryInterface $campPlaceRepository
     * @param CampPlaceService $campPlaceService
     */
    public function __construct(
        CampPlaceRepositoryInterface $campPlaceRepository,
        CampPlaceService $campPlaceService
    ) {
        $this->campPlaceRepository = $campPlaceRepository;
        $this->campPlaceService = $campPlaceService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function import()
    {
        // 管理者チェック
        if (!auth()->user()->admin_flg) {
            abort(404);
        }

        return view('mypage.camp-places.import');
    }

    /**
     * インポート処理
     *
     * @param CampPlaceImportRequest $request
     * @param FileService $fileService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postImport(CampPlaceImportRequest $request, FileService $fileService)
    {
        // 管理者チェック
        if (!auth()->user()->admin_flg) {
            abort(404);
        }

        // CSVファイルの内容を読み込み
        $csvArray =
            $fileService->loadCsv(
                $request->file('csv_file'),
                "public/imports/csv_files",
                $this->campPlaceService->getCsvColumnLabels(),
                $this->campPlaceService->getCsvColumns()
            );

        // CSV内容が不正の場合
        if (!$csvArray) {
            return redirect(route('mypage.camp-places.import'))->with('message-error', 'CSVファイルの内容が不正です');
        }

        // DB登録
        foreach ($csvArray as $index => $data) {
            $this->campPlaceRepository->store($data);
        }

        return redirect(route('mypage.camp-places.import'))->with('message', 'インポートが完了しました');
    }
}
