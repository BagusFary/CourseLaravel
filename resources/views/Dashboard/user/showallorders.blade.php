@extends('layouts.dashboard')

@section('content')
<div class="container">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
              <p><span class="h2">Order List </span><span class="h4">(You have {{ $dataOrder->count() }} orders )</span></p>
              <div class="card mb-4">
                <div class="card-body p-4">
                  <div class="row align-items-center">
                    @foreach ($dataOrder as $item)
                    <div class="col-md-2 mt-2">
                      <img src="{{ asset('/storage/thumbnail/'. $item->course->thumbnail) }}"
                        class="img-fluid" alt="Generic placeholder image">
                    </div>
                    <div class="col-md-2 d-flex justify-content-center">
                      <div>
                        <p class="small text-muted mb-2 ">Name</p>
                        <p class="lead fw-normal mb-0">{{ $item->course->title }}</p>
                      </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center">
                      <div>
                        <p class="small text-muted mb-2">Status</p>
                        <p class="lead fw-normal mb-0">
                          @if ($item->status == 'active')
                          <span class="badge rounded-pill text-bg-success">Active <i class="fa-regular fa-circle-check"></i></span>
                          @elseif($item->status == 'cancel')
                          <span class="badge rounded-pill text-bg-danger">Canceled <i class="fa-regular fa-circle-xmark"></i></span>
                          @elseif($item->status == 'pending')
                          <span class="badge rounded-pill text-bg-warning">Pending <i class="fa-regular fa-clock"></i></span>
                          @endif
                        </p>
                      </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center">
                      <div>
                        <p class="small text-muted mb-2">Order ID</p>
                        <p class="lead fw-normal mb-0">{{ $item->id }}</p>
                      </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center">
                      <div>
                        <p class="small text-muted mb-2 ">Price</p>
                        <p class="lead fw-normal mb-0">Rp.{{ number_format($item->price,2,',','.'); }}</p>
                        
                      </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center">
                      @if ($item->status != 'pending')
                      <a href="/invoice-detail/{{ $item->id }}" class="btn btn-outline-dark">Check invoice</a>
                      @endif
                    </div>
                    @endforeach
                  </div> 
                </div>
              </div>
            </div>
          </div>
        </div>
        {{ $dataOrder->links() }}
      </div>

  


@endsection