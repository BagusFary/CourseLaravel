@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="d-flex justify-content-center">Create Course</h2>
    <div class="d-flex justify-content-center">
        <form action="/store-course" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 ">
                <label for="title" class="form-label">Course Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Course Title" required>
            </div>
            <div class="mb-3 ">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="description" class="form-control" id="description" placeholder="Description" required>
            </div>
            <div class="mb-3">
                <label for="price">Price</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">Rp.</span>
                    <input type="number" name="price" class="form-control" placeholder="Price" required>
                </div>
            </div>
            <div class="mb-3 ">
                <button type="submit" class="btn btn-success">Create Course</button>
                <a href="/dashboard" class="btn btn-warning">Back/Cancel</a>
            </div>
        </form>
    </div>
</div>
    
@endsection