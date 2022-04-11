<?php

namespace Tests\app\Infrastructure\Controller;

use Exception;
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
    public function userListControllerHappyPathTest()
    {
        $users = ['id: 1','id: 2','id: 3'];
        $this->userDataSource
            ->expects('listUsers')
            ->once()
            ->andReturn($users);

        $response = $this->get('/api/users/list');

        $response->assertStatus(Response::HTTP_OK)->assertExactJson(['list' => ['id: 1','id: 2','id: 3']]);
    }
    /**
     * @test
     */
    public function userListControllerErrorTest()
    {
        $users = [''];
        $this->userDataSource
            ->expects('listUsers')
            ->once()
            ->andThrows(new \Exception('Hubo un error al realizar la peticion'));

        $response = $this->get('/api/users/list');
        $response->assertStatus(Response::HTTP_BAD_REQUEST)->assertExactJson(['error' => 'Hubo un error al realizar la peticion']);
    }
}
