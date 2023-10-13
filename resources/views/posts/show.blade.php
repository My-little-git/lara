@extends('layouts.main')

@section('content')
    <div>{{ $post->id }}. {{ $post->title }}</div>
    <div>{{ $post->content }}</div>
    <div><a href="{{ route('posts.edit', $post->id) }}">Edit</a></div>
    <div>
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
            @method('delete')
            <button class="btn btn-link text-danger p-0" type="submit">Delete</button>
            @csrf
        </form>
    </div>
    <div><a href="{{ route('posts.index') }}">Back</a></div>
@endsection
