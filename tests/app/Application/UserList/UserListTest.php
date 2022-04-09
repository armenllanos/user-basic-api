<?php

namespace Tests\app\Application\UserList;

use App\Application\UserDataSource\UserDataSource;
use App\Application\UserList\UserListService;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;

class UserListTest extends TestCase
{
    private UserListService $userListService;
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);

        $this->userListService = new UserListService($this->userDataSource);
    }

    /**
     * @test
     */
    public function emptyList()
    {
        $users = [''];
        $this->userDataSource
            ->expects('listUsers')
            ->once()
            ->andReturn($users);

        $result = $this->userListService->execute();

        $this->assertEquals($result,$users);
    }


}
