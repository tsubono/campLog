<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginEmailRequest;
use App\Http\Requests\Api\LoginTwitterRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
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
     * @param LoginEmailRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginByEmail(LoginEmailRequest $request)
    {
        try {
            $user = $this->userRepository->getByEmail($request->email);
            if ($user && Hash::check($request->password, $user->password)) {
                return response()->json([
                    'code' => 200,
                    'token' => $user->api_token,
                ], 200, [], JSON_PRETTY_PRINT);
            } else {
                return response()->json(['code' => 401, 'error_message' => '認証情報が不正です'], 401, [], JSON_PRETTY_PRINT);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'error_message' => $e->getMessage(),
            ], 500, [], JSON_PRETTY_PRINT);
        }
    }

    /**
     * @param LoginTwitterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginByTwitter(LoginTwitterRequest $request)
    {
        try {
            $user = $this->userRepository->getByTwitterToken($request->twitter_token);
            if ($user) {
                return response()->json([
                    'code' => 200,
                    'token' => $user->api_token,
                ], 200, [], JSON_PRETTY_PRINT);
            } else {
                return response()->json(['code' => 401, 'error_message' => '認証情報が不正です'], 401, [], JSON_PRETTY_PRINT);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'error_message' => $e->getMessage(),
            ], 500, [], JSON_PRETTY_PRINT);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken(Request $request)
    {
        try {
            $request->user()->update(
                [
                    'api_token' => Str::random(60),
                ]
            );

            return response()->json([
                'code' => 200,
            ], 200, [], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'error_message' => $e->getMessage(),
            ], 500, [], JSON_PRETTY_PRINT);
        }
    }
}
