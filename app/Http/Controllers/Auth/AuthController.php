<?php

namespace App\Http\Controllers\Auth;

use App\Models\RoleUser;
use App\Services\SetJWTCookie;
use Laravel\Lumen\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Cookie;

class AuthController extends BaseController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Login
     *
     * @return void
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * refresh
     *
     * @return void
     */
    public function refresh()
    {
        $token = auth()->refresh();
        return $this->respondWithToken($token);
    }

    /**
     * Logout
     *
     * @return void
     */
    public function logout()
    {
        auth()->logout();
        return response()->json([
            'message' => 'Logout with success!'
        ], 401);
    }
    function getRole(): string
    {
        return RoleUser::where("users_id", auth()->id())->first()->role();
    }
    /**
     * Undocumented function
     *
     * @param [type] $token
     * @return void
     */
    protected function respondWithToken($token)
    {
        $expire = auth()->factory()->getTTL() * 60;
        return response()->json(["message" => "authorized user"])->withCookie(SetJWTCookie::setCookie($token, $expire));
    }
}
