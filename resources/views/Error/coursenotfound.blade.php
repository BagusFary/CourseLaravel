@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5">Course Not Found.</p>
            <a href="/course" class="btn btn-outline-dark">Go Back to Homepage</a>
        </div>
    </div>
@endsection