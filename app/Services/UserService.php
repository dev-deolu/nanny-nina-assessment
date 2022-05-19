<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

final class UserService
{
    /**
     * Get all users
     * @param array $filters
     * @return null|\Illuminate\Database\Eloquent\Collection
     */
    public function get_users(array $filters): ?Collection
    {
        return User::filter($filters)->get();
    }
}
