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
    
          <form action="/update-course/{{ $dataCourse->id }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
                <div class="mb-2 mx-3">
                    <label for="title" class="form-label">Course Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="{{ $dataCourse->title }}" value="{{ $dataCourse->title }}">
                </div>
                    <div class="mx-3">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="10" rows="5" placeholder="{{ $dataCourse->description }}" value="{{ $dataCourse->description }}">{{ $dataCourse->description }}</textarea>
                    </div>
                <div class="mb-3 mx-3">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control" id="thumbnail">
                </div>
                <div class="mb-3 mx-3">
                    <label for="video">Video</label>
                    <input type="file" name="video" class="form-control" id="video">
                </div>
                <div class="mb-3 mx-3">
                    <label for="price">Price</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Rp.</span>
                        <input type="number" name="price" class="form-control" placeholder="Price" value="{{ $dataCourse->price }}" required>
                    </div>
                </div>
                <div class="mb-3 mx-3">
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="/show-all-courses" class="btn btn-warning">Back/Cancel</a>
                    <a href="/delete-course/{{ $dataCourse->id }}" class="btn btn-outline-danger">Delete</a>
                </div>
            </form>
    </div>
</div>
    
@endsection 