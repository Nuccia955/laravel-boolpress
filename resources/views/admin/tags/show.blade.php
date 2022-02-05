@extends('layouts.app')

@section('content')
    <section class="tags container">
        <h1>{{ $tag->title }}</h1>

        @if ($tag->posts->isEmpty())
            There's no posts for this tag!
        @else
            <ul class="list-group list-group-flush">
                @foreach ($tag->posts as $post )
                    <li class="list-group-item">
                        <article>
                            <h2 class="mb-1">{{ $post->title }}</h2>
                            <p class="mb-2">{{ $post->body }}</p>
                        </article>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>
@endsection