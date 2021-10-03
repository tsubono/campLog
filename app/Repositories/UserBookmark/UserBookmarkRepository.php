<?php

namespace App\Repositories\UserBookmark;

use App\Models\UserBookmark;
use Illuminate\Support\Collection;
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
    public function store(array $data): void
    {
        $this->userBookmark->create($data);
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
        $userBookmark = $this->userBookmark->findOrFail($id);
        $userBookmark->update($data);
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
