<?php

namespace App\Infrastructure\Providers;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;

class FakeUserDataSource implements UserDataSource
{

    public function findByEmail(string $email): User
    {
        // TODO: Implement findByEmail() method.
    }

    public function listUsers(): array
    {
        return ['id: 1','id: 2','id: 3'];
    }
}
