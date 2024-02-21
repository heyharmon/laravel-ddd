<?php

namespace DDD\Http\Auth;

use DDD\App\Controllers\Controller;
use DDD\Domain\Users\Resources\UserResource;
// Models

// Resources
use Illuminate\Http\Request;

class AuthMeController extends Controller
{
    public function __invoke(Request $request)
    {
        return new UserResource(auth()->user());
    }
}
