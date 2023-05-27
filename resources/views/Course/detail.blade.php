@extends('layouts.app')

@section('content')
    {{-- <div class="container">
        <div class="d-flex justify-content-start">
            <img src="{{ asset('/storage/thumbnail/'. $dataCourse->thumbnail) }}" class="img-fluid" alt="...">
        </div>
    </div>
    <div class="container">
        <div class="d-flex justify-content-start">
            <h2>{{ $dataCourse->title }}</h2>
        </div>
    </div> --}}
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-3">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">            
                    <img class="card-img-top mb-5 mb-md-0" src="{{ asset('/storage/thumbnail/'. $dataCourse->thumbnail) }}" alt="..." />
                </div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">{{ $dataCourse->title }}</h1>
                    <div class="fs-5 mb-5">
                        <span>Rp.{{ number_format($dataCourse->price,2,',','.') }}</span>
                    </div>
                    <p class="lead">{{ $dataCourse->description }}</p>
                    <div class="d-flex">
                      
                        <button type="button" class="btn btn-outline-dark flex-shrink-0" data-bs-toggle="modal" data-bs-target="#orderModal">
                            <i class="bi bi-cart">Order course</i>
                        </button>

                        <div class="modal fade" id="orderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Order Details</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    Name    : {{ Auth::user()->name }}
                                    <br>
                                    Product : {{ $dataCourse->title }}
                                    <br>
                                    Price   : Rp.{{ number_format($dataCourse->price,2,',','.') }}
                                    <br>
                                    <p class="lead fw-bold">
                                        Do you want to confirm your orders?    
                                    </p>   
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="/processing-orders/{{ $dataCourse->id }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-dark flex-shrink-0">Confirm Order</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection