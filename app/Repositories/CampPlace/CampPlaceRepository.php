<?php

namespace App\Repositories\CampPlace;

use App\Models\CampPlace;
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
     * 1件取得する
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
