@extends('layouts.dashboard')

@section('content')

<div class="container">
    <h2 class="d-flex justify-content-center">Create Course</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="d-flex justify-content-center col-sm-12">
        <form action="/store-course" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 ">
                <label for="title" class="form-label">Course Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Course Title" value="{{ old('title') }}" required>
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" cols="10" rows="5">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" name="thumbnail" class="form-control" id="thumbnail" value="{{ old('thumbnail') }}" required>
            </div>
            <div class="mb-3">
                <label for="video">Video</label>
                <input type="file" name="video" class="form-control" id="video" value="{{ old('video') }}" required>
            </div>
            <div class="mb-3">
                <label for="price">Price</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">Rp.</span>
                    <input type="number" name="price" class="form-control" placeholder="Price" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="name_tags">Tags</label>
                <input type="text" class="form-control" name="name_tags" id="name_tags" placeholder="Tags" required>
            </div>
            <div class="mb-3 ">
                <button type="submit" class="btn btn-success">Create Course</button>
                <a href="/dashboard" class="btn btn-warning">Back/Cancel</a>
            </div>
        </form>
    </div>
</div>
    
@endsection