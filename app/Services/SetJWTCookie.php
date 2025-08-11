<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Cookie;

class SetJWTCookie
{
    public static function setCookie(string $token, int $expire): Cookie
    {
        return new Cookie(
            'token',
            $token,
            $expire,
            '/',
            null,
            true, // Secure
            true, // HttpOnly
            false,
            Cookie::SAMESITE_STRICT
        );
    }
}
