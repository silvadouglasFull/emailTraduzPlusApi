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
            str_replace("http://", "", env("APP_URL")),
            true,
            true
        );
    }
}
