<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function update(int $id, array $data): void;
    public function destroy(int $id): void;
}
