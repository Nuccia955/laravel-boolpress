@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5 text-uppercase">Posts Archive</h1>

        @if (session('deleted'))
            <div class="alert alert-success">
                {{ session('deleted') }} successfully deleted!
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-1 px-4">
                <h3>ID</h3>
            </div>
            <div class="col-7 px-4">
                <h3>TITLE</h3>
            </div>
            <div class="col-4 px-4">
                <h3>ACTIONS</h3>
            </div>
        </div>
        <ul class="list-group list-group-flush">
            @foreach ($posts as $post )
                <li class="list-group-item">
                    <div class="row">
                        <h3 class="col-1">{{ $post->id }}</h3>
                        <h3 class="col-7 mb-3">{{ $post->title }}</h3>
                        <div class="actions col-4 d-flex justify-content-between w-25">
                            <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-success py-2">Show details</a>
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary py-2">Edit</a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want delete this post?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection