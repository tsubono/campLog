<?php

namespace App\Repositories\CampSchedule;

use App\Models\CampSchedule;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
     * @param int $userId
     * @param ?int $offset
     * @param ?int $limit
     * @param ?bool $isAll = false
     * @return Collection
     */
    public function getListByUserId(int $userId, ?int $offset = 0, ?int $limit = 10, ?bool $isAll = false): Collection
    {
        if ($isAll) {
            return $this->campSchedule->query()
            ->where('user_id', $userId)
            ->get();
        } else {
            return $this->campSchedule->query()
                ->where('user_id', $userId)
                ->offset(intval($offset))
                ->limit(intval($limit))
                ->get();
        }
    }

    /**
     * @param int $userId
     * @param int $paginationCount
     * @return LengthAwarePaginator
     */
    public function getPaginateByUserId(int $userId, int $paginationCount = 15): LengthAwarePaginator
    {
        return $this->campSchedule->query()
            ->where('is_public', true)
            ->where('user_id', $userId)
            ->orderBy('date', 'desc')
            ->paginate($paginationCount);
    }

    /**
     * 1件取得する
     *
     * @param ?int $id
     */
    public function getOne(?int $id)
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
                        // 画像回転
                        $rotate = (int)$data['rotates'][$index] ?? 0;
                        if ($rotate !== 0) {
                            $this->rotateImage($image, -$rotate);
                        }
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
                        // 画像回転
                        $rotate = (int)$data['rotates'][$index] ?? 0;
                        if ($rotate !== 0) {
                           $this->rotateImage($image, -$rotate);
                        }
                        // 画像をDBに保存 or 更新
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
     * 画像を回転する
     *
     * @param $image
     * @param $rotate
     */
    private function rotateImage($image, $rotate)
    {
        $imgName = basename($image);
        $extensions = pathinfo($image)['extension'];

        // 通常画像
        $imagePath = storage_path(). "/app/public/uploaded/camp-schedule/{$imgName}";
        $source = imagecreatefromjpeg($imagePath);
        $rotated = imagerotate($source, $rotate, 0);
        // リサイズされた画像
        $imagePathResized = storage_path(). "/app/public/uploaded/camp-schedule/resized-{$imgName}";
        $sourceResized = imagecreatefromjpeg($imagePathResized);
        $rotatedResized = imagerotate($sourceResized, $rotate, 0);

        if($extensions == "jpeg" || $extensions == "jpg"){
            imagejpeg($rotated, $imagePath);
            imagejpeg($rotatedResized, $imagePathResized);
        }elseif($extensions == "png"){
            imagepng($rotated, $imagePath);
            imagepng($rotatedResized, $imagePathResized);
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
