@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Auth::check())
        <div class="d-flex justify-content-center">
            <div class="col-md-4">
                <form action="" method="get" class="d-flex" role="search">
                    <input class="form-control me-2" name="keyword" type="search" placeholder="Find here.." aria-label="Search">
                    <button class="btn btn-outline-dark" type="submit">Search</button>
                </form>
            </div>
        </div>
        @endif
        <div class="row">
         @forelse ($dataCourse as $item)
            <div class="col-md-4 mb-5 mt-3 d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('storage/thumbnail/'.$item->thumbnail) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">{{ $item->title }}</h5>
                        @foreach ($item->tags as $tag)
                             <a href="/course?keyword={{ $tag->name_tags }}"><span class="badge text-bg-secondary">{{ $tag->name_tags }}</span></a>
                        @endforeach
                      <p class="card-text">{{ $item->description }}</p>
                      <p>Rp.{{ number_format($item->price,2,',','.'); }}</p>
                      <a href="/detail-course/{{ $item->id }}" class="btn btn-outline-dark">Course Detail</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="d-flex justify-content-center">
                <div class="mt-5">
                    <h2>No Course Found :(</h2>
                </div>
            </div>
         @endforelse
        </div>
        <div class="mb-3">
            {{ $dataCourse->links() }}
        </div>
    </div>


@endsection

