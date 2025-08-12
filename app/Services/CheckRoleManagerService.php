<?php

namespace App\Services;


class CheckRoleManagerService implements CheckRoleInterface
{
    public function check(string $role): bool
    {
        return (strtolower($role) === "manager");
    }
}
