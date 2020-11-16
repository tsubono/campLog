<?php

namespace App\Http\Controllers\Mypage;

use App\Http\Requests\CampScheduleRequest;
use App\Http\Requests\ServiceRequest;
use App\Models\CampSchedule;
use App\Repositories\CampPlace\CampPlaceRepositoryInterface;
use App\Repositories\CampSchedule\CampScheduleRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CampScheduleController extends Controller
{
    private CampPlaceRepositoryInterface $campPlaceRepository;
    private CampScheduleRepositoryInterface $campScheduleRepository;

    /**
     * CampScheduleController constructor.
     *
     * @param CampPlaceRepositoryInterface $campPlaceRepository
     * @param CampScheduleRepositoryInterface $campScheduleRepository
     */
    public function __construct(
        CampPlaceRepositoryInterface $campPlaceRepository,
        CampScheduleRepositoryInterface $campScheduleRepository
    ) {
        $this->campPlaceRepository = $campPlaceRepository;
        $this->campScheduleRepository = $campScheduleRepository;
    }

    /**
     * キャンプ予定一覧
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $campSchedules = $this->campScheduleRepository->getByCondition(['user_id' => auth()->user()->id]);
        return view('mypage.camp-schedules.index', compact('campSchedules'));
    }

    /**
     * キャンプ予定登録フォーム
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $campSchedule = new CampSchedule();
        $campPlaces = $this->campPlaceRepository->getAll();
        return view('mypage.camp-schedules.create', compact('campSchedule', 'campPlaces'));
    }

    /**
     * キャンプ予定登録処理
     *
     * @param CampScheduleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CampScheduleRequest $request)
    {
        $this->campScheduleRepository->store($request->all() + ['user_id' => auth()->user()->id]);

        return redirect(route('mypage.camp-schedules.index'))->with('message', 'キャンプ予定を登録しました');
    }

    /**
     * キャンプ予定編集フォーム
     *
     * @param CampSchedule $campSchedule
     * @return \Illuminate\View\View
     */
    public function edit(CampSchedule $campSchedule)
    {
        $campPlaces = $this->campPlaceRepository->getAll();

        return view('mypage.camp-schedules.edit', compact('campSchedule', 'campPlaces'));
    }

    /**
     * キャンプ予定更新処理
     *
     * @param CampScheduleRequest $request
     * @param CampSchedule $campSchedule
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CampSchedule $campSchedule, CampScheduleRequest $request)
    {
        $this->campScheduleRepository->update($campSchedule->id, $request->all());

        return redirect(route('mypage.camp-schedules.index'))->with('message', 'キャンプ予定を更新しました');
    }

    /**
     * キャンプ予定削除処理
     *
     * @param CampSchedule $campSchedule
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(CampSchedule $campSchedule)
    {
        $this->campScheduleRepository->destroy($campSchedule->id);

        return redirect(route('mypage.camp-schedules.index'))->with('message', 'キャンプ予定を削除しました');
    }
}
