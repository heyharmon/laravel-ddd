<?php

namespace DDD\Http\Auth;

use Illuminate\Http\JsonResponse;
use DDD\App\Controllers\Controller;
use DDD\Domain\Invitations\Invitation;
// Models
use DDD\Domain\Organizations\Resources\OrganizationResource;
use DDD\Domain\Users\User;
// Requests
use DDD\Http\Auth\Requests\AuthRegisterWithInvitationRequest;
// Resources
use Illuminate\Support\Facades\Hash;

class AuthRegisterWithInvitationController extends Controller
{
    public function __invoke(Invitation $invitation, AuthRegisterWithInvitationRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $invitation->email,
            'role' => 'editor', // TODO: Remove
            'organization_id' => $invitation->organization->id,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        $invitation->delete();

        return response()->json([
            'message' => 'Registration successful',
            'data' => [
                'access_token' => $token,
                'name' => $user->name,
                'email' => $user->email,
                'organization' => new OrganizationResource($user->organization),
            ],
        ], 200);
    }
}
