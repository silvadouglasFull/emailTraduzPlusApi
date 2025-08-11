<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data)
    {
        try {
            $password = Hash::make($data["password"]);
            $data["password"] = $password;
            $user = User::create($data);
            return $user;
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }
}
