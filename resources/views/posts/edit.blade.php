@extends('layouts.main')

@section('content')
    <form action=" {{ route('posts.update', $post->id) }} " method="POST">
        @method('patch')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input name="title" value="{{ $post->title }}" type="text" class="form-control" id="title">
            @error('title')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" class="form-control" id="content" style="height: 100px">{{ $post->content }}</textarea>
            @error('content')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input name="image" value="{{ $post->image }}" type="text" class="form-control" id="image">
            @error('image')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Категория</label>
            <select name="category_id" id="category" class="form-select" aria-label="Default select example">
                <option
                    {{ $post->category->id ? '' : 'selected' }}
                    disabled
                    class="d-none">-- Выберите категорию --</option>
                @foreach($categories as $category)
                    <option
                        {{ $category->id === $post->category->id ? 'selected' : ''}}
                        value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tags" class="form-label">Теги</label>
            <select name="tags[]" id="tags" class="form-select" multiple aria-label="Multiple select example">
                @foreach($tags as $tag)
                    <option
                        {{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? 'selected' : ''}}
                        value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
            @error('tags')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        @csrf
    </form>
@endsection
