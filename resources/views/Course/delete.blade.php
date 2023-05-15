@extends('layouts.app')

@section('content')

<div class="container">
  <form action="/destroy-course/{{ $dataCourse->id }}" method="POST">
    @method('delete')
    @csrf
    <div class="mt-3 d-flex justify-content-center">
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $dataCourse->title }}</h5>
              <p class="card-text">{{ $dataCourse->description }}</p>
              <p>{{ $dataCourse->price }}</p>
              <a href="#" class="btn btn-primary disabled">Go somewhere</a>
            </div>
          </div>
            <div class="mt-2 mx-2">
              <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Delete Course?')"            >Delete Course</button>
              <a href="/edit-course/{{ $dataCourse->id }}" class="btn btn-warning">Back/Cancel</a>
            </div>
        </form>
    </div>
    
@endsection