@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="list-group list-group-flush">
            @foreach ($posts as $post )
                <li class="list-group-item">
                    <h3 class="mb-3">{{ $post->title }}</h3>
                    <p>{{ $post->body }}</p>
                </li>
            @endforeach
        </ul>
    </div>
@endsection