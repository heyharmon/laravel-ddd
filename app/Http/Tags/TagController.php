<?php

namespace DDD\Http\Tags;

use DDD\App\Controllers\Controller;
use DDD\Domain\Tags\Resources\TagResource;
// Models
use DDD\Domain\Tags\Tag;
// Resources
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::parents()->latest()->get();

        return TagResource::collection($tags);
    }

    public function store(Request $request)
    {
        $tag = Tag::create($request->all());

        return new TagResource($tag);
    }

    public function show(Tag $tag)
    {
        $tag = $tag->descendantsAndSelf()->get()->toTree();

        return new TagResource($tag->first());
    }

    public function update(Tag $tag, Request $request)
    {
        $tag->update($request->all());

        return new TagResource($tag);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return new TagResource($tag);
    }
}
