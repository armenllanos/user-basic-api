<?php

namespace App\Infrastructure\Controllers;

use App\Application\UserList\UserListService;
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

            $users = $this->userListService->execute();
           return response()->json([
            'list'=>$users
        ], Response::HTTP_OK);
    }
}
