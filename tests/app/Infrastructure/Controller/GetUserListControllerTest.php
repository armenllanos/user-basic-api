<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use Mockery;
use Illuminate\Http\Response;
use Tests\TestCase;


class GetUserListControllerTest extends TestCase
{
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);
        $this->app->bind(UserDataSource::class, fn () => $this->userDataSource);
    }

    /**
     * @test
     */
    public function userListIsEmptyTest()
    {
        $users = [''];
        $this->userDataSource
            ->expects('listUsers')
            ->once()
            ->andReturn($users);

        $response = $this->get('/api/users/list');

        $response->assertExactJson(['list' => ['']]);
    }
}
