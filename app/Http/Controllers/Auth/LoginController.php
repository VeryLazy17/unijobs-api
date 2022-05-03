<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $this->validate(request(), [
            'email' => 'email|required',
            'password' => 'required|max:8',
        ], [
            'email.email' => 'Kiritilgan login elektron pochta ko\'rinishida bo\'lishi zarur!',
            'email.required' => 'Login maydoni bo\'sh bo\'lmasligi zarur!',
            'password.required' => 'Parol maydoni bo\'sh bo\'lmasligi zarur!',
            'password.max' => 'Parol miqdori 8 ta belgidan oshmasligi zarur!',
        ]);

        $user = User::where('email', $request['email'])->first();

        if ($user) {
            if (!Hash::check($request['password'], $user['password'])) {
                return response()->json([
                    'message' => 'Kiritilgan parol noto\'g\'ri!',
                ], 422);
            }
        } else {
            return response()->json([
                'message' => 'Kiritilgan email noto\'g\'ri!'
            ], 422);
        }

        $tokenResult = $user->createToken('token')->plainTextToken;


        return response()->json([
            'token' => $tokenResult,
            'role' => $user->role->name,
            'user_id' => $user->id
        ]);
    }

    public function logout(): JsonResponse
    {
        Auth::user()?->tokens()->delete();

        return response()->json([
            'message' => 'Logged out',
        ]);
    }
}
