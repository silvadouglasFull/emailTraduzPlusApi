<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestInterface;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends BaseController
{
    private UserRepositoryInterface $userRepository;
    private RequestInterface $userRequest;
    public function __construct(
        UserRepositoryInterface $userRepository,
        RequestInterface $userRequest
    ) {
        $this->userRepository  = $userRepository;
        $this->userRequest = $userRequest;
    }
    /**
     * Get user actual
     *
     * @return void
     */
    public function me()
    {
        return response()->json(
            auth()->user()
        );
    }

    /**
     * Get list of users
     *
     * @return void
     */
    public function getUsers()
    {
        return response()->json([
            'list' => User::all()
        ]);
    }
    public function register(Request $request)
    {
        try {
            if ($this->validate($request, $this->userRequest->rules())) {
                $data = $request->all();
                unset($data["password_confirmation"]);
                $user = $this->userRepository->create($data);
                if (!$user) {
                    throw new Exception("Error Processing Request", 1);
                }
                return response()->json(["message" => "User registred", "data" => $user], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }
}
