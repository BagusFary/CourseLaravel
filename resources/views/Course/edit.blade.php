@extends('layouts.dashboard')

@section('content')

<div class="container">
    <h2 class="d-flex justify-content-center">Edit Course</h2>
    <div class="d-flex justify-content-center mt-3">
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $dataCourse->title }}</h5>
              <p class="card-text">{{ $dataCourse->description }}</p>
              <p>Rp.{{ number_format($dataCourse->price,2,',','.'); }}</p>
              <a href="#" class="btn btn-success disabled">Course Detail</a>
            </div>
          </div>
          <form action="/update-course/{{ $dataCourse->id }}" method="POST">
            @method('put')
            @csrf
                <div class="mb-2 mx-3">
                    <label for="title" class="form-label">Course Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="{{ $dataCourse->title }}" value="{{ $dataCourse->title }}">
                </div>
                <div class="mb-2 mx-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" name="description" class="form-control" id="description" placeholder="{{ $dataCourse->description }}" value="{{ $dataCourse->description }}">
                </div>
                <div class="mb-2 mx-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" id="price" placeholder="Rp.{{ number_format($dataCourse->price,2,',','.'); }}" value="{{ $dataCourse->price }}">
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