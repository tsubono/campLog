<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    private UserRepositoryInterface $userRepository;

    /**
     * LoginController constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->userRepository->store(array_merge($request->all(), [
                'handle_name' => $request->get('handle_name', 'no name'),
                'api_token' => Str::random(60),
                'password' => $request->password ? Hash::make($request->password) : null,
                'email_verified_at' => now(),
            ]));

            return response()->json([
                'code' => 200,
                'token' => $user->api_token,
            ], 200, [], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'error_message' => $e->getMessage(),
            ], 500, [], JSON_PRETTY_PRINT);
        }
    }
}
