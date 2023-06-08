@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center">
        <p class="lead text-gray-800 mt-5">
            Your order has been placed 
            <i class="bi bi-check-circle fa-lg"></i>
        </p>
        
        <p class="lead mt-2">Waiting for Admin Approvement</p>
        <a href="/show-user-orders" class="btn btn-outline-dark">Check your orders</a>
    </div>
</div>
@endsection