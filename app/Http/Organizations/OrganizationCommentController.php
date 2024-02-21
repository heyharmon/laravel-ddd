<?php

namespace DDD\Http\Organizations;

use DDD\App\Controllers\Controller;
// Requests
use DDD\Domain\Comments\Comment;
// Resources
use DDD\Domain\Comments\Requests\CommentStoreRequest;
// Models
use DDD\Domain\Comments\Resources\CommentResource;
use DDD\Domain\Organizations\Organization;

class OrganizationCommentController extends Controller
{
    public function index(Organization $organization)
    {
        return CommentResource::collection(
            $organization->comments()->with(['children', 'user'])->get()
        );
    }

    public function store(Organization $organization, CommentStoreRequest $request)
    {
        $comment = $organization->comments()->make($request->validated());

        $request->user()->comments()->save($comment);

        return new CommentResource($comment);
    }

    public function destroy(Organization $organization, Comment $comment)
    {
        $comment->delete();

        return new CommentResource($comment);
    }
}
