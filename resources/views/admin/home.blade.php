@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-2">Welcome {{ Auth::user()->name }}!</h1>
                </div>

                <div class="card-body">
                    <h2 class="mb-4">Menu</h2>
                    <span class="fs-3">Start Here!</span>
                    <ul>
                        <li>
                            <a href="#">Link</a>
                        </li>
                        <li>
                            <a href="#">Link</a>
                        </li>
                        <li>
                            <a href="#">Link</a>
                        </li>
                        <li>
                            <a href="#">Link</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
