@extends('layouts.dashboard')

@section('content')
<div class="container">
    
    <div class="card">
        <div class="card-body">
          <div class="container mb-5 mt-3">
            <div class="row d-flex align-items-baseline">
              <div class="col-xl-9">
                <p style="color: #7e8d9f;font-size: 20px;">Invoice &gt;&gt; <strong>ID:{{ $invoiceData->id }} #</strong></p>
              </div>
            </div>
            <div class="container">
              <div class="col-md-12">
                <div class="text-center">
                  <i class="fa-brands fa-laravel fa-2xl"></i>
                  <p class="pt-2">Laravel Course</p>
                </div>
              </div>
              <div class="row">
                <div class="col-xl-8">
                  <ul class="list-unstyled">
                    <li class="text-muted">To: <span style="color:#8f8061 ;">{{ $invoiceData->orders->user->name }}</span></li>
                    <li class="text-muted">Street, City</li>
                    <li class="text-muted">State, Country</li>
                    <li class="text-muted"><i class="fa-regular fa-envelope"></i> {{ $invoiceData->orders->user->email }}</li>
                  </ul>
                </div>
                <div class="col-xl-4">
                  <p class="text-muted">Invoice</p>
                  <ul class="list-unstyled">
                    <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061 ;"></i> <span
                        class="fw-bold">ID:</span>#{{ $invoiceData->id }}</li>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061 ;"></i> <span
                        class="fw-bold">Creation Date: </span>{{ date("Y-m-d", strtotime($invoiceData->created_at))}}</li>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061;"></i> <span
                        class="me-1 fw-bold">Status:</span>
                        @if ($invoiceData->status == "paid")
                            <span class="badge text-bg-success">Paid</span>  
                        @elseif($invoiceData->status == "unpaid")
                            <span class="badge text-bg-warning">Unpaid</span>
                            @elseif($invoiceData->status == "cancel")
                            <span class="badge text-bg-danger">Canceled</span>
                        @endif
                    </li>
                  </ul>
                </div>
              </div>
              <div class="row my-2 mx-1 justify-content-center">
                <div class="col-md-2 mb-4 mb-md-0">
                  <div class="
                              bg-image
                              ripple
                              mb-4
                              overflow-hidden
                              d-block
                              " data-ripple-color="light">
                    <img src="{{ asset('/storage/thumbnail/'. $invoiceData->orders->course->thumbnail) }}"
                      class="w-100" height="90px"  />
                    <a href="#!">
                      <div class="hover-overlay">
                        <div class="mask" style="background-color: hsla(0, 0%, 98.4%, 0.2)"></div>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-md-7 mb-4 mb-md-0">
                  <p class="fw-bold">{{ $invoiceData->orders->course->title }}</p>
                  <p class="mb-1">
                    <span class="text-muted me-2">Order ID:</span><span>{{ $invoiceData->orders->id }}</span>
                  </p>
                  <p>
                    <span class="text-muted me-2">Order Date:</span><span>{{ date("Y-m-d", strtotime($invoiceData->orders->created_at)) }}</span>
                  </p>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                  <h5 class="mb-2">
                    @if ($invoiceData->status == "cancel")
                    <s class="align-middle">Rp.{{ number_format($invoiceData->orders->course->price,2,',','.'); }}</s>
                    @elseif($invoiceData->status != "cancel")
                    <span class="align-middle">Rp.{{ number_format($invoiceData->orders->course->price,2,',','.'); }}</span>
                    @endif
                  </h5>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-xl-8">
                  <p class="ms-3">Add additional notes and payment information</p>
                </div>
                <div class="col-xl-3">
                    @if ($invoiceData->status == "cancel")
                    <s class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span
                        style="font-size: 17px;">Rp.{{ number_format($invoiceData->orders->course->price,2,',','.'); }}</span></s>
                    @elseif($invoiceData->status != "cancel")
                    <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span
                        style="font-size: 17px;">Rp.{{ number_format($invoiceData->orders->course->price,2,',','.'); }}</span></p>
                    @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
</div>
@endsection