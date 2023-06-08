@extends('layouts.dashboard')

@section('content')

    @can('admin')
    <h1 class="h3 text-gray-800">Welcome back , {{ Auth::user()->name }} </h1>
    @endcan

    @can('user')
    <h1 class="h3 text-gray-800">Welcome back , {{ Auth::user()->name }} </h1>
    @endcan

    
    

@endsection
