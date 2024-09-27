<?php
namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Services\ApiResponseService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $userType = $request->input('user_type'); // تحديد نوع المستخدم من الطلب

        $response = $this->authService->login($credentials, $userType);

        if ($response['status'] === 'error') {
            return ApiResponseService::error($response['message'], $response['code']);
        }

        return ApiResponseService::success([
            'user' => $response['user'],
            'authorisation' => [
                'token' => $response['token'],
                'type' => 'bearer',
            ]
        ], 'Login successful', $response['code']);
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $userType = $request->input('user_type'); // تحديد نوع المستخدم من الطلب

        $response = $this->authService->register($data, $userType);

        return ApiResponseService::success([
            'user' => $response['user'],
            'authorisation' => [
                'token' => $response['token'],
                'type' => 'bearer',
            ]
        ], 'User created successfully', $response['code']);
    }

    public function logout()
    {
        $userType = request()->input('user_type'); // تحديد نوع المستخدم من الطلب
        $response = $this->authService->logout($userType);

        return ApiResponseService::success(null, $response['message'], $response['code']);
    }
}
