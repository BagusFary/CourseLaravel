@extends('layouts.dashboard')

@section('content')

@push('styles')
    @livewireStyles
@endpush
@push('scripts')
    @livewireScripts
@endpush


<div class="container">

    <h2 class="d-flex justify-content-center">Edit Course</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @livewire('edit-course', ["dataCourse" => $dataCourse])
    </div>
    
@endsection 