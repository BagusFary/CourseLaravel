@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="d-flex justify-content-start">
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $dataCourse->title }}</h5>
              <p class="card-text">{{ $dataCourse->description }}</p>
              <p>{{ $dataCourse->price }}</p>
              <a href="#" class="btn btn-primary disabled">Go somewhere</a>
            </div>
          </div>
    </div>
        <form action="/update-course/{{ $dataCourse->id }}" method="POST">
        @method('put')
        @csrf
            <div class="mb-3 col-md-4">
                <label for="title" class="form-label">Course Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="{{ $dataCourse->title }}" value="{{ $dataCourse->title }}">
            </div>
            <div class="mb-3 col-md-4">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="description" class="form-control" id="description" placeholder="{{ $dataCourse->description }}" value="{{ $dataCourse->description }}">
            </div>
            <div class="mb-3 col-md-4">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" class="form-control" id="price" placeholder="Rp.{{ $dataCourse->price }}" value="{{ $dataCourse->price }}">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="/course" class="btn btn-danger">Back/Cancel</a>
                <form action="/delete-course" method="POST">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-warning">Delete Course</button>
                </form>
            </div>
        </form>
</div>
    
@endsection