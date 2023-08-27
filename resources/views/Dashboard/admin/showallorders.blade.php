@extends('layouts.dashboard')

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush

@section('content')


@livewire('list-order-admin')

@endsection