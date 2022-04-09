<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetUserControllerTest extends TestCase
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
    public function userWithGivenIdDoesExist()
    {
        $user = new User(1, 'email@email.com');
        $this->userDataSource
            ->expects('findById')
            ->with('1')
            ->once()
            ->andReturn($user);

        $response = $this->get('/api/users/1');

        $response->assertStatus(Response::HTTP_OK)->assertExactJson(['user_id' => 1,'email' => 'email@email.com']);
    }

    /**
     * @test
     */
    public function userWithGivenIdDoesNotExist()
    {
        $this->userDataSource
            ->expects('findById')
            ->with('999')
            ->once()
            ->andReturn(null);

        $response = $this->get('/api/users/999');

        $response->assertStatus(Response::HTTP_BAD_REQUEST)->assertExactJson(['error' => 'Usuario no encontrado']);
    }

    /**
     * @test
     */
    public function getUserByIdThrowsException()
    {
        $this->userDataSource
            ->expects('findById')
            ->with('545')
            ->once()
            ->andThrow(new Exception());

        $response = $this->get('/api/users/545');

        $this->expectException(Exception::class);

        $response->assertExactJson(['error' => 'Hubo un error al realizar la petición']);
    }

    /**
     * @test
     */
    public function userIdNotEspecifiedInRoute()
    {
        $this->userDataSource
            ->expects('findById')
            ->withNoArgs()
            ->never()
            ->andThrow(new Exception('El id del usuario es obligatorio'));

        $response = $this->get('/api/users/');

        $this->expectException(Exception::class);

        $response->assertExactJson(['error' => 'El id del usuario es obligatorio']);
    }
}
