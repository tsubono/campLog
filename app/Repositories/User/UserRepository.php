<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class UserRepository
 *
 * @package App\Repositories\User
 */
class UserRepository implements UserRepositoryInterface
{
    private User $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * ユーザー名からユーザー情報を取得する
     *
     * @param string $userName
     * @return User|null
     */
    public function getByUserName(string $userName)
    {
        return $this->user->where('name', $userName)->first();
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
            $user = $this->user->findOrFail($id);
            $user->update($data);

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
            $user = $this->user->findOrFail($id);
            $user->delete();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }
}
