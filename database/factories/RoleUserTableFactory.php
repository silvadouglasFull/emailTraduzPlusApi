<?php

namespace Database\Factories;

use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleUserTableFactory extends Factory
{
    protected $model = RoleUser::class;

    public function definition(): array
    {
        return [
            'role' => 'Admin',
            'users_id' => User::factory(), // Cria usuário automaticamente se não existir
        ];
    }
}
