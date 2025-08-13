<?php

namespace Database\Seeders;

use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        RoleUser::create([
            'users_id' => $user->id,
            'role' => 'Admin'
        ]);
    }
}
