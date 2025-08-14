<?php

namespace App\Services\CheckRole;


class CheckRoleAdminService implements CheckRoleInterface
{
    public function check(string $role): bool
    {
        return (strtolower($role) === "admin");
    }
}
