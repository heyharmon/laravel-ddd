<?php

namespace DDD\Http\Auth;

use DDD\App\Controllers\Controller;
use Illuminate\Http\Request;

class AuthLogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Tokens Revoked',
        ], 200);
    }
}
