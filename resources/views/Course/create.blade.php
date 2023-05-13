@extends('layouts.admin')

@section('content')
<form action="/store-course" method="post">
    @csrf
    <div class="container">
            <div class="mb-3 col-sm-5">
                <label for="title" class="form-label">Course Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Course Title">
            </div>
            <div class="mb-3 col-sm-5">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="description" class="form-control" id="description" placeholder="Description">
            </div>
            <div class="mb-3 col-sm-5">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" class="form-control" id="price" placeholder="Price">
            </div>
            <div class="mb-3 col-sm-5">
                <button type="submit" class="btn btn-success">Create Course</button>
            </div>
    </div>
</form>
    
@endsection