@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
         @foreach ($dataCourse as $item)
            <div class="col-md-4 mb-5 mt-3 d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">{{ $item->title }}</h5>
                      <p class="card-text">{{ $item->description }}</p>
                      <p>Rp.{{ $item->price }}</p>
                      <a href="#" class="btn btn-success">Course Detail</a>
                      <a href="edit-course/{{ $item->id }}" class="btn btn-warning">Edit Course</a>
                    </div>
                </div>
            </div>
         @endforeach
        </div>
    </div>
@endsection
