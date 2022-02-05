@extends('layouts.app')

@section('content')
    <section class="posts-archive container">
        <h1 class="mb-5 text-uppercase">Posts Archive</h1>

        @if (session('deleted'))
            <div class="alert alert-success">
                {{ session('deleted') }} successfully deleted!
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title}}</td>
                        <td>
                            @if ($post->category_id)
                                <a href="{{ route('admin.category', $post->category->id) }}">{{ $post->category->name }}</a>
                            @else
                                Uncathegorized
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-success">Show details</a>
                        </td>
                        <td>
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section class="tags container">
        <h5 class="mb-3">
            Tags
        </h5>
        <ul>
            @foreach ($tags as $tag)
                <li>
                    <a href="{{ route('admin.tag', $tag->id) }}">{{ $tag->title }}</a>
                </li>
            @endforeach
        </ul>
    </section>
@endsection