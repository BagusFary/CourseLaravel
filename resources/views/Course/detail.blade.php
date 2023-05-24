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
                        <button class="btn btn-outline-dark flex-shrink-0" type="button">
                            <i class="bi bi-cart"></i>
                            Buy course
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection