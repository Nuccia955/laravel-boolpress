@extends('layouts.app')

@section('content')
    <section class="create-post container">
        <h1 class="mb-5 text-uppercase">Add a new Post</h1>

        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

            <label for="title" class="form-label mb-1">Title</label>
            <input class="form-control mb-4 @error('body') is-invalid @enderror" type="text" id="title" name="title" value="{{ old('title') }}">
            {{-- display error title --}}
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="body" class="form-label mb-1">Body</label>
            <textarea class="form-control mb-4 @error('body') is-invalid @enderror" id="body" name="body" rows="8">{{ old('body') }}</textarea>
            {{-- display error body --}}
            @error('body')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="category_id" class="mb-1">Category</label>
            <select name="category_id" id="category_id" class="form-control mb-4">
                <option value="">Uncathegorized</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            {{-- display error select --}}
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="tags mb-4">
                <span class="d-block">Tags</span>
                @foreach ($tags as $tag) 
                    <span class="d-inline-block mr-3">
                        <input type="checkbox"
                            name="tags[]"
                            id='tag {{ $loop->iteration }}'
                            value='{{ $tag->id }}'
                            @if (in_array($tag->id, old('tags', [])))
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
            <input type="file" id="cover" name="cover" class="d-block mb-4">
            @error('cover')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button class="btn btn-success" type="submit">Add post</button>
        </form>
    </section>    
@endsection