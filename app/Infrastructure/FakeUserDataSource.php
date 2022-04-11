<?php

namespace App\Infrastructure;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;

class FakeUserDataSource implements UserDataSource
{

    public function findByEmail(string $email): User
    {
        // TODO: Implement findByEmail() method.
    }

    public function findById(string $id_user)
    {
        if($id_user > 500)
        {
            return null;
        }
       return new User($id_user, "testing@email");
    }

    public function listUsers(): array
    {
        return ['id: 1','id: 2','id: 3'];
    }
}
