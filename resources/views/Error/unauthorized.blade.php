@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center">
            <div class="error mx-auto" data-text="401">401</div>
            <p class="lead text-gray-800 mb-5">UNAUTHORIZED</p>
            <a href="/course" class="btn btn-outline-dark">Go Back</a>
        </div>
    </div>
@endsection