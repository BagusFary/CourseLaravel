@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center">
        <p class="lead text-gray-800 mt-5">
            Your order failed to be made
            <i class="bi bi-x-circle fa-lg"></i>
        </p>
        
        <p class="lead mt-2">Please try again later</p>
        <a href="/course" class="btn btn-outline-dark">Go Back</a>
    </div>
</div>
@endsection