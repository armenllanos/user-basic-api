<?php

namespace App\Infrastructure\Controllers;

use App\Application\UserList\UserListService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUserListController extends BaseController
{
    public function __construct(UserListService $userListService)
    {
        $this->userListService = $userListService;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $users = $this->userListService->execute();
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
        return response()->json([
            'list'=>$users
        ], Response::HTTP_OK);

    }
}
