<?php

namespace App\Http\Controllers\Posts;

use App\Http\Requests\Posts\StoreRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class StoreController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $post = $this->service->store($data);

        if ($post instanceof Post) {
            return new PostResource($post);
        }

        return $post;
//        return to_route('posts.index');
    }
}
