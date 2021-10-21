<?php

namespace App\Repositories\UserBookmark;

use App\Models\UserBookmark;
use Illuminate\Database\Eloquent\Collection;

interface UserBookmarkRepositoryInterface
{
    public function getByCondition(array $condition): Collection;
    public function getListByUserId(int $userId, ?int $offset = 1, ?int $limit = 10, ?bool $isAll = false): Collection;
    public function findByCondition(array $condition);
    public function store(array $data): UserBookmark;
    public function update(int $id, array $data): UserBookmark;
    public function updateSort(array $bookmarks): void;
    public function destroy(int $id): void;
}
