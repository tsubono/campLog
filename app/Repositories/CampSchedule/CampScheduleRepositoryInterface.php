<?php

namespace App\Repositories\CampSchedule;

use App\Models\CampSchedule;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CampScheduleRepositoryInterface
{
    public function getByCondition(array $condition, int $paginationCount = 20): LengthAwarePaginator;
    public function getOne(int $id): CampSchedule;
    public function store(array $data): CampSchedule;
    public function update(int $id, array $data): CampSchedule;
    public function destroy(int $id): void;
}
