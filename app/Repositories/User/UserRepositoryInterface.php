<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function getByUserName(string $userName);
    public function update(int $id, array $data): void;
    public function destroy(int $id): void;
}
