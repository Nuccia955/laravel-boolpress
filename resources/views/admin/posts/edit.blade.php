@extends('layouts.app')

@section('content')
    <section class="create-post container">
        <h1 class="mb-5 text-uppercase">Edit {{ $post->title }}</h1>

        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <label for="title" class="form-label mb-1">Title</label>
            <input class="form-control mb-4 @error('title') is-invalid @enderror" type="text" id="title" name="title" value="{{ old('title', $post->title) }}">
            {{-- display error title --}}
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="body" class="form-label mb-1">Body</label>
            <textarea class="form-control mb-4 @error('body') is-invalid @enderror" id="body" name="body" rows="8">{{ old('body', $post->body) }}</textarea>
            {{-- display error body --}}
            @error('body')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="category_id" class="mb-1">Category</label>
            <select name="category_id" id="category_id" class="form-control mb-4">
                <option value="">Uncathegorized</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @if ($category->id == old('category_id', $post->category_id))
                            selected
                        @endif    
                    >{{ $category->name }}</option>
                @endforeach
            </select>
            {{-- display error select --}}
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="tags">
                <span class="d-block">Tags</span>
                @foreach ($tags as $tag) 
                    <span class="d-inline-block mr-3">
                        <input type="checkbox"
                            name="tags[]"
                            id='tag {{ $loop->iteration }}'
                            value='{{ $tag->id }}'
                            @if ($errors->any() && in_array($tag->id, old('tags')))
                                checked
                            @elseif (!$errors->any() && $post->tags->contains($tag->id))
                                checked
                            @endif
                        >
                        <label for="tag {{ $loop->iteration }}">
                            {{ $tag->title }}
                        </label>
                    </span>
                @endforeach
            </div>
            @error('tags')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="cover">Cover</label>
            @if ($post->cover)
                <div class="cover d-block">
                    <img src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
                </div>
            @endif
            <input type="file" id="cover" name="cover" class="d-block mb-4">
            @error('cover')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button class="btn btn-primary" type="submit">Update post</button>
        </form>
    </section>    
@endsection