<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PostController extends Controller
{

    public function create()
    {
//        $postsArr = [
//            [
//                'title' => 'a',
//                'content' => 'a',
//                'image' => 'a',
//                'likes' => '4',
//                'is_published' => '1',
//            ],
//            [
//                'title' => 'b',
//                'content' => 'b',
//                'image' => 'b',
//                'likes' => '3',
//                'is_published' => '0',
//            ],
//        ];
//
//        foreach ($postsArr as $posts){
//            Posts::create($posts);
//        }


    }

    public function store(Request $request) {

    }

    public function edit()
    {

    }

    public function update( Request $request)
    {

    }

    public function show()
    {

    }

    public function delete()
    {
        $post = Post::withTrashed()->find(2);

        $post->restore();

        dd('restored');
    }

    public function destroy()
    {

    }

    public function firstOrCreate()
    {
        $anotherPost = [
            'title' => 'another title',
            'content' => 'another content',
            'image' => 'another image',
            'likes' => 300,
            'is_published' => 1,
        ];

        $post = Post::firstOrCreate(
            ['title' => 'Один шаг'],
            $anotherPost
        );

        dd($post->title);
    }

    public function updateOrCreate()
    {
        $anotherPost = [
            'title' => 'another title updated',
            'content' => 'another content',
            'image' => 'another image',
            'likes' => 300,
            'is_published' => 1,
        ];

        $post = Post::updateOrCreate(
            ['title' => 'another title'],
            $anotherPost
        );

        dd($post->title);
    }
}
