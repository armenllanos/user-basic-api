<?php

namespace App\Application\UserDataSource;

use App\Domain\User;

Interface UserDataSource
{
    public function findByEmail(string $email): User;
    public function listUsers(): array;
    public function findById(string $id_user);

}
