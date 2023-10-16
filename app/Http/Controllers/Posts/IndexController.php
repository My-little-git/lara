<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use App\Http\Requests\Posts\FilterRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();

        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;

        $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
        $posts = Post::filter($filter)->paginate($perPage, ['*'], 'page', $page);
//        return view('posts.index', compact('posts'));

        return PostResource::collection($posts);
    }
}
