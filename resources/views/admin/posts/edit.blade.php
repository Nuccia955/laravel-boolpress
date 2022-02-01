@extends('layouts.app')

@section('content')
    <section class="create-post container">
        <h1 class="mb-5 text-uppercase">Edit {{ $post->title }}</h1>

        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
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

            <button class="btn btn-primary" type="submit">Update post</button>
        </form>
    </section>    
@endsection