<?php

namespace App\Application\GetUser;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;

class GetUserService
{
    /**
     * @var UserDataSource
     */
    private $userDataSource;

    /**
     * GetUserService constructor.
     * @param UserDataSource $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    /**
     * @param string $id_user
     * @throws Exception
     */
    public function execute(string $id_user)
    {
            $user = $this->userDataSource->findById($id_user);
            return $user;
    }
}
