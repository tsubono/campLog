<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;

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
            // twitter登録の場合はメール認証は不要
            $email_verified_at = !empty($request->twitter_token) ? now() : null;
            $user = $this->userRepository->store(array_merge($request->all(), [
                'handle_name' => $request->get('handle_name', 'no name'),
                'api_token' => Str::random(60),
                'password' => $request->password ? Hash::make($request->password) : null,
                'email_verified_at' => $email_verified_at,
            ]));

            if (is_null($email_verified_at)) {
                // 認証メール送信
                event(new Registered($user));
            }

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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resendVerify(Request $request)
    {
        try {
            $user = $request->user();
            if (is_null($user->email_verified_at)) {
                // 認証メール送信
                event(new Registered($user));

                return response()->json([
                    'code' => 200,
                ], 200, [], JSON_PRETTY_PRINT);
            } else {
                return response()->json([
                    'code' => 200,
                    'message' => '既にメール認証済みです',
                ], 200, [], JSON_PRETTY_PRINT);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'error_message' => $e->getMessage(),
            ], 500, [], JSON_PRETTY_PRINT);
        }
    }
}
