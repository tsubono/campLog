<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserUpdateRequest;
use App\Repositories\User\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        return response()->json([
            'code' => 200,
            'user' => $request->user(),
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * @param UserUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserUpdateRequest $request)
    {
        try {
            $data = $request->except(['id', 'api_token', 'admin_flg', 'access_count']);
            if (!empty($data)) {
                if (empty($data['password'])) {
                    unset($data['password']);
                } else {
                    $data['password'] = bcrypt($data['password']);
                }
                $data['camp_start_date'] =
                    !empty($data['camp_start_date_y']) && !empty($data['camp_start_date_m']) ? Carbon::parse("{$data['camp_start_date_y']}-{$data['camp_start_date_m']}-1") : null;
                $user = $this->userRepository->update($request->user()->id, $data);
            }

            return response()->json([
                'code' => 200,
                'user' => $user,
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
    public function destroy(Request $request)
    {
        try {
            $this->userRepository->destroy($request->user()->id);

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
