<?php

namespace App\Http\Controllers\Posts;

use App\Http\Requests\Posts\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class UpdateController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Post $post, UpdateRequest $request)
    {
        $data = $request->validated();

        $post = $this->service->update($post, $data);

        return new PostResource($post);

//        return to_route('posts.show', $post->id);
    }
}
