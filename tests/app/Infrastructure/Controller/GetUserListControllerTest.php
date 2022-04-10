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

        $response->assertStatus(Response::HTTP_OK)->assertExactJson(['list' => ['']]);
    }
    /**
     * @test
     */
    public function userListHappyPathTest()
    {
        $users = ['id: 1','id: 2','id: 3'];
        $this->userDataSource
            ->expects('listUsers')
            ->once()
            ->andReturn($users);

        $response = $this->get('/api/users/list');

        $response->assertStatus(Response::HTTP_OK)->assertExactJson(['list' => ['id: 1','id: 2','id: 3']]);
    }
}
