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
          <div class="container-fluid">
            <a href="/delete-course/{{ $dataCourse->id }}" class="btn btn-outline-danger" onclick="return confirm('Delete Course?')">Delete Course</a>
            <a href="/edit-course/{{ $dataCourse->id }}" class="btn btn-warning">Back/Cancel</a>
          </div>
    </div>
@endsection