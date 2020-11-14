<?php

namespace App\Repositories\AccessToken;

interface AccessTokenRepositoryInterface
{
    public function store(array $data): void;
    public function destroy(int $id): void;
}
