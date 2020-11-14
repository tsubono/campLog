<?php

namespace App\Repositories\AccessToken;

use App\Models\AccessToken;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class AccessTokenRepository
 *
 * @package App\Repositories\AccessToken
 */
class AccessTokenRepository implements AccessTokenRepositoryInterface
{
    private AccessToken $accessToken;

    public function __construct(AccessToken $accessToken) {
        $this->accessToken = $accessToken;
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
            $this->accessToken->create($data);

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
            $accessToken = $this->accessToken->findOrFail($id);
            $accessToken->delete();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }
}
