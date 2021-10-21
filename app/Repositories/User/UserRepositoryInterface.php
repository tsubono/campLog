<?php

namespace App\Repositories\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getByUserName(string $userName);
    public function getByEmail(string $email);
    public function getByTwitterToken(string $twitterToken);
    public function store(array $data): User;
    public function update(int $id, array $data): User;
    public function destroy(int $id): void;
}
