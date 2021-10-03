<?php

namespace App\Repositories\UserBookmark;

use Illuminate\Support\Collection;

interface UserBookmarkRepositoryInterface
{
    public function getByCondition(array $condition): Collection;
    public function findByCondition(array $condition);
    public function store(array $data): void;
    public function update(int $id, array $data): void;
    public function updateSort(array $bookmarks): void;
    public function destroy(int $id): void;
}
