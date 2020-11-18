<?php

namespace App\Repositories\AccessCode;

use App\Models\AccessCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class AccessCodeRepository
 *
 * @package App\Repositories\AccessCode
 */
class AccessCodeRepository implements AccessCodeRepositoryInterface
{
    private AccessCode $accessCode;

    public function __construct(AccessCode $accessCode) {
        $this->accessCode = $accessCode;
    }

    /**
     * 取得する
     *
     * @return AccessCode
     */
    public function find(): AccessCode
    {
        return $this->accessCode->first();
    }

    /**
     * 更新する
     *
     * @param int $id
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function update(int $id, array $data): void
    {
        DB::beginTransaction();
        try {
            $accessToken = $this->accessCode->findOrFail($id);
            $accessToken->update($data);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }
}
