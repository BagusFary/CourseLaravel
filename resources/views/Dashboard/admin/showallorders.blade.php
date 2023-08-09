@extends('layouts.dashboard')

@section('content')

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush

@livewire('list-order-admin')

@endsection