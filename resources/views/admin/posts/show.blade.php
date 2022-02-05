@extends('layouts.app')

@section('content')
    <section class="show-details container">
        <h1 class="mb-1 text-uppercase">
            {{ $post->title }}
        </h1>
        <div class="badge bg-danger text-light p-2 mb-5">
            @if ($post->category)
                {{ $post->category->name }}
            @else
                Uncathegorized
            @endif
        </div>
        <div class="actions d-flex justify-content-end w-100 mb-5">
            <a class="btn btn-success" href="{{ route('admin.posts.index') }}">Back to archive</a>
        </div>

        <p class="col-6 mb-3">{!! $post->body !!}</p>
        <div class="tags mb-3">
            @if (!$post->tags->isEmpty())
                <h5 class="mb-1 text-uppercase">Tags</h5>
                @foreach ($post->tags as $tag )
                    <div class="badge bg-info text-light">
                        {{ $tag->title }}
                    </div>
                @endforeach
            @else
                <p>No tags found for this post</p>
            @endif
        </div>

        <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>

    </section>
@endsection