<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserCollection;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Get Users
     * @authenticated
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // return (new UserCollection());
    }
}
