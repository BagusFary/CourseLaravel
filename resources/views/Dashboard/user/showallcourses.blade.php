@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Your Course:</h2>
   <div class="row">
     @forelse ($dataCourse[0]->orders as $item)
        <div class="col-md-4 mb-5 mt-3 d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <video src={{ asset('/storage/video/'. $item->course->video) }} class="card-img-top" controls></video>

                <div class="card-body">
                  <h5 class="card-title">{{ $item->course->title }}</h5>
                  <p class="card-text">{{ $item->course->description }}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="container d-flex justify-content-center mt-4">
            <h2>No Course Found:(</h2>
        </div>
        <div class="container d-flex justify-content-center">
            
                <a href="/course" class="btn btn-outline-dark">See more Course here</a>
        </div>
     @endforelse
    </div>
    {{ $dataCourse->links() }}
</div>
@endsection