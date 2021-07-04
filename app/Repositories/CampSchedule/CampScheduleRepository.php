<?php

namespace App\Repositories\CampSchedule;

use App\Models\CampSchedule;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class CampScheduleRepository
 *
 * @package App\Repositories\CampSchedule
 */
class CampScheduleRepository implements CampScheduleRepositoryInterface
{
    private CampSchedule $campSchedule;

    public function __construct(CampSchedule $campSchedule) {
        $this->campSchedule = $campSchedule;
    }

    /**
     * 条件から検索取得する
     *
     * @param array $condition
     * @param int $paginationCount
     * @return LengthAwarePaginator
     */
    public function getByCondition(array $condition, int $paginationCount = 10): LengthAwarePaginator
    {
        $query = $this->campSchedule->query();

        if (!empty($condition['user_id'])) {
            $query->where('user_id', $condition['user_id']);
        }
        if (!empty($condition['keyword'])) {
            $query->where(function($query) use ($condition) {
                $query->where('title', 'LIKE',  "%{$condition['keyword']}%");
                $query->orWhere('content', 'LIKE', "%{$condition['keyword']}%");
            });
        }

        return $query->orderBy('date', 'desc')->paginate($paginationCount);
    }

    /**
     * 1件取得する
     *
     * @param int $id
     * @retusn CampSchedule
     */
    public function getOne(int $id): CampSchedule
    {
        return $this->campSchedule->find($id);
    }

    /**
     * 登録する
     *
     * @param array $data
     * @retusn CampSchedule
     * @throws \Exception
     */
    public function store(array $data): CampSchedule
    {
        DB::beginTransaction();
        try {
            // 予定登録
            $campSchedule = $this->campSchedule->create($data);
            // 画像登録
            if (isset($data['images'])) {
                foreach ($data['images'] as $index => $image) {
                    if (!empty($image)) {
                        $campSchedule->images()->create([
                            'image_path' => $image,
                            'sort' => $index
                        ]);
                    }
                }
            }

            DB::commit();

            return $campSchedule;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }

    /**
     * 更新する
     *
     * @param int $id
     * @param array $data
     * @retusn CampSchedule
     * @throws \Exception
     */
    public function update(int $id, array $data): CampSchedule
    {
        DB::beginTransaction();
        try {
            $campSchedule = $this->campSchedule->findOrFail($id);
            // 予定更新
            $campSchedule->update($data);
            // 画像削除されているものがあれば削除
            $savedImagePaths = [];
            foreach ($campSchedule->images as $image) {
                $savedImagePaths[] = $image->image_path;
                if (!isset($data['images']) || !in_array($image->image_path, $data['images'])) {
                    $image->delete();
                }
            }
            // 画像更新
            if (isset($data['images'])) {
                foreach ($data['images'] as $index => $image) {
                    if (!empty($image)) {
                        if (!in_array($image, $savedImagePaths)) {
                            $campSchedule->images()->create([
                                'image_path' => $image,
                                'sort' => $index
                            ]);
                        } else {
                            $campSchedule->images()->where('image_path', $image)->update([
                                'image_path' => $image,
                                'sort' => $index
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return $campSchedule;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }

    /**
     * 削除する
     *
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function destroy(int $id): void
    {
        DB::beginTransaction();
        try {
            $campSchedule = $this->campSchedule->findOrFail($id);
            $campSchedule->delete();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }
}
