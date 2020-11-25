<?php

namespace App\Repositories\CampPlace;

use Illuminate\Database\Eloquent\Collection;

interface CampPlaceRepositoryInterface
{
    public function getAll(): Collection;
    public function findByName(string $name);
    public function store(array $data): void;
    public function update(int $id, array $data): void;
    public function destroy(int $id): void;
}
