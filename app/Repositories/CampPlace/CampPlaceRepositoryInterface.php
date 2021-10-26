<?php

namespace App\Repositories\CampPlace;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface CampPlaceRepositoryInterface
{
    public function getAll(): Collection;
    public function getByConditionPaginate(array $condition, int $perCount = 10): LengthAwarePaginator;
    public function getList(?int $offset = 1, ?int $limit = 10, ?bool $isAll = false, ?string $keyword = null): Collection;
    public function getOne(?int $id);
    public function findByName(string $name);
    public function store(array $data): void;
    public function update(int $id, array $data): void;
    public function destroy(int $id): void;
}
