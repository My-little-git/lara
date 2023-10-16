<?php

namespace App\Http\Controllers\Posts;

use App\Http\Requests\Posts\StoreRequest;
use App\Http\Resources\ErrorResource;
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
        try {

            $data = $request->validated();

            $post = $this->service->store($data);

            return new PostResource($post);

        } catch (\UnexpectedValueException $e) {

            return new ErrorResource($e);

        }
//        return to_route('posts.index');
    }
}
