@extends('layouts.app')

@section('content')
    <section class="create-post container">
        <h1 class="mb-5 text-uppercase">Add a new Post</h1>

        <form action="{{ route('admin.posts.store') }}" method="POST">
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

            <button class="btn btn-success" type="submit">Add post</button>
        </form>
    </section>    
@endsection