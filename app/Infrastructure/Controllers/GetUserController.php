<?php

namespace App\Infrastructure\Controllers;

use App\Application\GetUser\GetUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use PHPUnit\Util\Exception;

class GetUserController extends BaseController
{

    private $getUserService;

    /**
     * IsEarlyAdopterUserController constructor.
     */
    public function __construct(GetUserService $getUserService)
    {
        $this->getUserService = $getUserService;
    }

    public function __invoke(string $id_user): JsonResponse
    {
        try {
            $user = $this->getUserService->execute($id_user);

            if(is_null($user))
                return response()->json(['error' => 'Usuario no encontrado'], Response::HTTP_BAD_REQUEST);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }


        return response()->json(['user_id' => $user->getId(), 'email' => $user->getEmail()], Response::HTTP_OK);

    }
}
