<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserCollection;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Get Users
     * @authenticated
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, UserService $user_service)
    {
        /** Possible filter params */
        return (new UserCollection($user_service->get_users($request->only('level', 'timezone', 'name'))));
    }
}
