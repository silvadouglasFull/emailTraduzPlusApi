<?php

namespace App\Services\CheckRole;

interface CheckRoleInterface
{
    public function check(string $role): bool;
}
