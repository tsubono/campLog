<?php

namespace App\Repositories\CampSchedule;

use App\Models\CampSchedule;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface CampScheduleRepositoryInterface
{
    public function getByCondition(array $condition, int $paginationCount = 20): LengthAwarePaginator;
    public function getListByUserId(int $userId, ?int $offset = 1, ?int $limit = 10, ?bool $isAll = false): Collection;
    public function getOne(?int $id);
    public function store(array $data): CampSchedule;
    public function update(int $id, array $data): CampSchedule;
    public function destroy(int $id): void;
}
