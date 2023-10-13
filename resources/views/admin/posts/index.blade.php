@extends('layouts.admin')

@section('content')

    <div class="mb-3">
        <a class="btn btn-primary" href="{{ route('posts.create') }}">Add one</a>
    </div>
    @foreach($posts as $post)
        <div><a href="{{ route('posts.show', $post->id) }}">{{ $post->id }}. {{ $post->title }}</a></div>
    @endforeach

    <div>
        {{ $posts->withQueryString()->links() }}
    </div>

@endsection
