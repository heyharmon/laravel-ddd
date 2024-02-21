<?php

namespace DDD\Http\Auth;

use Illuminate\Http\JsonResponse;
use DDD\App\Controllers\Controller;
use DDD\Domain\Users\User;
// Models
use DDD\Http\Auth\Requests\AuthRegisterRequest;
// Requests
use Illuminate\Support\Facades\Hash;

// Resources

class AuthRegisterController extends Controller
{
    public function __invoke(AuthRegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'admin', // TODO: Remove
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        // TODO: Create an organization for this user

        return response()->json([
            'message' => 'Registration successful',
            'data' => [
                'access_token' => $token,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ], 200);
    }
}
