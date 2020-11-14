<?php

namespace App\Repositories\CampPlace;

use Illuminate\Database\Eloquent\Collection;

interface CampPlaceRepositoryInterface
{
    public function getAll(): Collection;
    public function store(array $data): void;
    public function destroy(int $id): void;
}
