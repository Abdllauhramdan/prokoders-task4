<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\Teacher;

class AuthService
{
    public function login(array $credentials, $userType)
    {
        // تحديد الـ guard حسب نوع المستخدم
        $guard = $userType === 'student' ? 'students' : 'teachers';

        if (!$token = Auth::guard($guard)->attempt($credentials)) {
            return [
                'status' => 'error',
                'message' => 'Unauthorized',
                'code' => 401,
            ];
        }

        return [
            'status' => 'success',
            'user' => Auth::guard($guard)->user(),
            'token' => $token,
            'code' => 200,
        ];
    }

    public function register(array $data, $userType)
    {
        $userModel = $userType === 'student' ? Student::class : Teacher::class;

        $user = $userModel::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = Auth::guard($userType)->login($user);

        return [
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'token' => $token,
            'code' => 201,
        ];
    }

    public function logout($userType)
    {
        Auth::guard($userType)->logout();

        return [
            'status' => 'success',
            'message' => 'Successfully logged out',
            'code' => 200,
        ];
    }
}
