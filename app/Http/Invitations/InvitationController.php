<?php

namespace DDD\Http\Invitations;

use DDD\App\Controllers\Controller;
use DDD\Domain\Invitations\Invitation;
use DDD\Domain\Invitations\Mail\InvitationEmail;
// Emails
use DDD\Domain\Invitations\Requests\InvitationStoreRequest;
// Models
use DDD\Domain\Invitations\Resources\InvitationResource;
use DDD\Domain\Organizations\Organization;
// Requests
use Illuminate\Http\Request;
// Resources
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    public function index(Organization $organization)
    {
        $invitations = $organization->invitations()
            ->latest()
            ->get();

        return InvitationResource::collection($invitations);
    }

    public function store(Organization $organization, InvitationStoreRequest $request)
    {
        $invitation = $organization->invitations()->create(
            $request->validated()
        );

        Mail::to($invitation->email)->send(new InvitationEmail($invitation));

        return new InvitationResource($invitation);
    }

    public function show(Organization $organization, Invitation $invitation)
    {
        return new InvitationResource($invitation->load(['organization', 'user']));
    }

    // public function update(Organization $organization, Invitation $invitation, Request $request)
    // {
    //     $invitation->update($request->all());
    //
    //     return response()->json($invitation);
    // }

    public function destroy(Organization $organization, Invitation $invitation)
    {
        $invitation->delete();

        return new InvitationResource($invitation);
    }
}
