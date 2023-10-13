<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use App\Http\Requests\Posts\FilterRequest;
use App\Models\Post;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FilterRequest $request)
    {
        $this->authorize('view', auth()->user());

        $data = $request->validated();
        $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
        $posts = Post::filter($filter)->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }
}
