@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container px-4 px-lg-5 my-3">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">            
                <img class="card-img-top mb-5 mb-md-0" src="{{ asset('/storage/thumbnail/'. $dataCourse->thumbnail) }}" alt="..." />
            </div>
            <div class="col-md-6">
                <h1 class="display-5 fw-bolder">Order Details</h1>
                <div class="fs-5 mb-2">
                    <h1 class="display-8">{{ $dataCourse->title }}</h1>
                </div>
                <div class="fs-5 mb-2">
                    <span>{{ $dataCourse->description }}</span>
                </div>
                <div class="fs-5 mb-2">
                    <span>Rp.{{ number_format($dataCourse->price,2,',','.') }}</span>
                </div>
                <div class="d-flex">
                    <button type="button" class="btn btn-outline-dark flex-shrink-0" data-bs-toggle="modal" data-bs-target="#confirmModal">
                        <i class="bi bi-cart">Confirm Payment</i>
                    </button>

                    <div class="modal fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Payment Confirmation</h1>
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
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="course_id" value="{{ $dataCourse->id }}">
                                    <input type="hidden" name="price" value="{{ $dataCourse->price }}">
                            <button type="submit" class="btn btn-outline-dark flex-shrink-0">Confirm Payment</button>
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

