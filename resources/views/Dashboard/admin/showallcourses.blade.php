@extends('layouts.dashboard')
@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush

@section('content')
<div class="container">
    
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-regular fa-circle-check"></i><strong> {{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if (session('failed'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa-regular fa-circle-xmark"></i><strong> {{ session('failed') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="container">
        <div class="d-flex justify-content-center">
            <form action="" method="get" class="d-flex" role="search">
                <input class="form-control me-2" name="keyword" type="search" placeholder="Search Course" aria-label="Search">
                <button class="btn btn-outline-dark" type="submit">Search</button>
            </form>
        </div>
    </div>
    
    <div class="row">
     @forelse ($dataCourse as $item)
        <div class="col-md-4 mb-5 mt-3 d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/thumbnail/'. $item->thumbnail) }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ $item->title }}</h5>
                    @foreach ($item->tags as $tag)
                        <span class="badge text-bg-secondary">{{ $tag->name_tags }}</span>
                    @endforeach
                  <p class="card-text">{{ $item->description }}</p>
                  <p>Rp.{{ number_format($item->price,2,',','.'); }}</p>
                  <a href="/edit-tags/{{ $item->id }}" class="btn btn-outline-secondary">Edit Tags</a>
                  <a class="btn btn-warning" href="/edit-course/{{ $item->id }}">Edit Course</a>
                </div>
            </div>
        </div>
        @empty
        <h2>No Course Found:(</h2>
     @endforelse
    </div>
    {{ $dataCourse->links() }}
</div>
@endsection