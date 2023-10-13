@extends('layouts.main')

@section('content')
    <form action=" {{ route('posts.store') }} " method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input value="{{ old('title') }}" name="title" type="text" class="form-control" id="title">
            @error('title')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" class="form-control" id="content" style="height: 100px">{{ old('content') }}</textarea>
            @error('content')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input value="{{ old('image') }}" name="image" type="text" class="form-control" id="image">
            @error('image')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Категория</label>
            <select name="category_id" id="category" class="form-select" aria-label="Default select example">
                <option
                    {{ old('category_id') ? '' : 'selected' }}
                    disabled
                    class="d-none">-- Выберите категорию --</option>
                @foreach($categories as $category)
                    <option
                        {{ (int)old('category_id') === $category->id ? 'selected' : '' }}
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
                    <option {{ in_array($tag->id, old('tags') ?: []) ? 'selected' : '' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
            @error('tags')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
        @csrf
    </form>
@endsection
