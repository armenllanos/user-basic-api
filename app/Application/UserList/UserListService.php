<?php

namespace App\Application\UserList;

use App\Application\UserDataSource\UserDataSource;

class UserListService
{
    /**
     * @var UserDataSource
     */
    private $userDataSource;

    /**
     * IsEarlyAdopterService constructor.
     * @param UserDataSource $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function execute(): array
    {
        $users = $this->userDataSource->listUsers();
        return $users;
    }
}
