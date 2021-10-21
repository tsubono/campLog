<?php

namespace App\Repositories\UserBookmark;

use App\Models\UserBookmark;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

/**
 * Class UserBookmarkRepository
 *
 * @package App\Repositories\UserBookmark
 */
class UserBookmarkRepository implements UserBookmarkRepositoryInterface
{
    private UserBookmark $userBookmark;

    public function __construct(UserBookmark $userBookmark)
    {
        $this->userBookmark = $userBookmark;
    }

    /**
     * @param array $condition
     * @return Collection
     */
    public function getByCondition(array $condition): Collection
    {
        $query = $this->userBookmark->query();

        if (!empty($condition['user_id'])) {
            $query->where('user_id', $condition['user_id']);
        }

        if (!empty($condition['camp_place_id'])) {
            $query->where('camp_place_id', $condition['camp_place_id']);
        }

        return $query->orderBy('sort')->get();
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
            return $this->userBookmark->query()
                ->where('user_id', $userId)
                ->get();
        } else {
            return $this->userBookmark->query()
                ->where('user_id', $userId)
                ->offset(intval($offset))
                ->limit(intval($limit))
                ->get();
        }
    }

    /**
     * @param array $condition
     */
    public function findByCondition(array $condition)
    {
        $query = $this->userBookmark->query();

        if (!empty($condition['user_id'])) {
            $query->where('user_id', $condition['user_id']);
        }

        if (!empty($condition['camp_place_id'])) {
            $query->where('camp_place_id', $condition['camp_place_id']);
        }

        return $query->first();
    }

    /**
     * 登録する
     *
     * @param array $data
     * @throws \Exception
     */
    public function store(array $data): UserBookmark
    {
        return $this->userBookmark->create($data);
    }

    /**
     * 更新する
     *
     * @param int $id
     * @param array $data
     * @throws \Exception
     */
    public function update(int $id, array $data): UserBookmark
    {
        $userBookmark = $this->userBookmark->findOrFail($id);
        $userBookmark->update($data);

        return $userBookmark;
    }

    /**
     * @param array $bookmarks
     */
    public function updateSort(array $bookmarks): void
    {
        foreach ($bookmarks as $index => $bookmark) {
            $target = $this->userBookmark->findOrFail($bookmark->id);
            $target->update([
                'sort' => $index + 1,
            ]);
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
        $userBookmark = $this->userBookmark->findOrFail($id);
        $userBookmark->delete();
    }
}
