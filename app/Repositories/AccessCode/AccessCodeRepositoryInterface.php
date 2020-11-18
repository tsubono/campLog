<?php

namespace App\Repositories\AccessCode;

use App\Models\AccessCode;

interface AccessCodeRepositoryInterface
{
    public function find(): AccessCode;
    public function update(int $id, array $data): void;
}
