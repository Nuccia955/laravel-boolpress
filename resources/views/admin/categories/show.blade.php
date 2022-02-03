@extends('layouts.app')

@section('content')
    <section class="show-details container">
        <h1 class="mb-5 text-uppercase">
            {{ $category->name }}
        </h1>

        <ul class="list-group list-group-flush">
            @foreach ($category->posts as $post )
                <li class="list-group-item">
                    <article>
                        <h2 class="mb-1">{{ $post->title }}</h2>
                        <p class="mb-2">{{ $post->body }}</p>

                        <div class="actions">
                            <a class="btn btn-success" href="{{ route('admin.posts.show', $post->slug) }}">Show details</a>
                            <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                        </div>
                    </article>
                </li>
            @endforeach
        </ul>
    </section>
@endsection