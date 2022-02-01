@extends('layouts.app')

@section('content')
    <section class="show-details container">
        <h1 class="mb-5 text-uppercase">
            {{ $post->title }}
        </h1>

        <div class="actions d-flex justify-content-between w-100 mb-5">
            <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
            <a class="btn btn-success" href="{{ route('admin.posts.index') }}">Back to archive</a>
        </div>

        <p class="col-6">{!! $post->body !!}</p>
    </section>
@endsection