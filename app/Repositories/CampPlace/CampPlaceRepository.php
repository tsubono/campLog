<?php

namespace App\Repositories\CampPlace;

use App\Models\CampPlace;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CampPlaceRepository
 *
 * @package App\Repositories\CampPlace
 */
class CampPlaceRepository implements CampPlaceRepositoryInterface
{
    private CampPlace $campPlace;

    public function __construct(CampPlace $campPlace) {
        $this->campPlace = $campPlace;
    }

    /**
     * 全件取得する
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->campPlace->all();
    }

    /**
     * 全件取得する (検索用)
     *
     * @return Collection
     */
    public function getForSelectBox(): Collection
    {
        return $this->campPlace->query()
            ->get()
            ->makeHidden(['camp_schedule_reviews']);
    }

    /**
     * @param array $condition
     * @param int $perCount
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getByConditionPaginate(array $condition, int $perCount = 10): LengthAwarePaginator
    {
        $query = $this->campPlace->query();

        if (!empty($condition['name'])) {
            $query->where('name', 'LIKE', "%{$condition['name']}%");
        }

        if (!empty($condition['address'])) {
            $query->where('address', 'LIKE', "%{$condition['address']}%");
        }

        return $query
            ->orderBy('name', 'desc')
            ->paginate($perCount);
    }

    /**
     * @param ?int $offset
     * @param ?int $limit
     * @param ?bool $isAll = false
     * @param ?string $keyword = null
     * @return Collection
     */
    public function getList(?int $offset = 0, ?int $limit = 10, ?bool $isAll = false, ?string $keyword = null): Collection
    {
        if ($isAll) {
            if (!is_null($keyword)) {
                $campPlaces = $this->campPlace->query()
                    ->where('name', 'LIKE', "%$keyword%")
                    ->get();
            } else {
                $campPlaces = $this->campPlace->all();
            }
        } else {
            if (!is_null($keyword)) {
                $campPlaces = $this->campPlace->query()
                    ->where('name', 'LIKE', "%$keyword%")
                    ->offset(intval($offset))
                    ->limit(intval($limit))
                    ->get();
            } else {
                $campPlaces = $this->campPlace
                    ->offset(intval($offset))
                    ->limit(intval($limit))
                    ->get();
            }
        }

        return $campPlaces;
    }

    /**
     * idから1件取得する
     *
     * @param ?int $id
     */
    public function getOne(?int $id)
    {
        return $this->campPlace->find($id);
    }

    /**
     * nameから1件取得する
     *
     * @param string $name
     */
    public function findByName(string $name)
    {
        return $this->campPlace->query()->where('name', $name)->first();
    }

    /**
     * 登録する
     *
     * @param array $data
     * @retusn void
     * @throws \Exception
     */
    public function store(array $data): void
    {
        DB::beginTransaction();
        try {
            $this->campPlace->create($data);

            DB::commit();

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
     * @throws \Exception
     */
    public function update(int $id, array $data): void
    {
        DB::beginTransaction();
        try {
            $campPlace = $this->campPlace->findOrFail($id);
            $campPlace->update($data);

            DB::commit();

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
            $campPlace = $this->campPlace->findOrFail($id);
            $campPlace->delete();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }
}
