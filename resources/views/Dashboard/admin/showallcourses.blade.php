@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
     @forelse ($dataCourse as $item)
        <div class="col-md-4 mb-5 mt-3 d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/thumbnail/'. $item->thumbnail) }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ $item->title }}</h5>
                  <p class="card-text">{{ $item->description }}</p>
                  <p>Rp.{{ number_format($item->price,2,',','.'); }}</p>
                  <a href="#" class="btn btn-success">Course Detail</a>
                  <a class="btn btn-warning" href="/edit-course/{{ $item->id }}">Edit Course</a>
                </div>
            </div>
        </div>
        @empty
        <h2>No Course Found:(</h2>
     @endforelse
    </div>
</div>
@endsection