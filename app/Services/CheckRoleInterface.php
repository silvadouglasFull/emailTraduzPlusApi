<?php

namespace App\Services;

interface CheckRoleInterface
{
    public function check(string $role): bool;
}
