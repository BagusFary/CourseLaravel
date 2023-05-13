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
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
    </div>
        <form action="/update-course/{{ $dataCourse->id }}" method="POST">
        @method('put')
        @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Course Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Course Title">
            </div>
        </form>
</div>
    
@endsection