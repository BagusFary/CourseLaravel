@extends('layouts.app')

@section('content')

@push('styles')
    @livewireStyles
@endpush
@push('scripts')
    @livewireScripts
@endpush

<div class="container">
    @livewire('index-course')
</div>

@endsection

