@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Approve Orders</h2>
    @if(Session::has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="fa-regular fa-circle-check fa-xl"></i><strong> {{ Session::get('message') }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <table class="table table-secondary table-striped">
        <tr>
            <th>Order ID</th>
            <th>Name</th>
            <th>Product</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @forelse ($dataOrder as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->course->title }}</td>
            <td>Rp.{{ number_format($item->price,2,',','.'); }}</td>
            <td>{{ $item->status }}</td>
            <td>  
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#order-{{ $item->id }}">
                    <i class="fa-solid fa-check"></i>
                </button>    
                <button class="btn btn-danger">
                    <i class="fa-solid fa-xmark"></i>
                </button>          
       
            </td>
        </tr>
        <div class="modal fade" id="order-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Approve Confirmation</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Name : {{ $item->user->name }}
                    <br>
                    Product :{{ $item->course->title }}
                    <br>
                    Price : Rp.{{ number_format($item->price,2,',','.'); }}
                    <br>
                    Status : {{ $item->payment_status }}
                    <br>
                  Approve Order?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <form action="/approve/{{ $item->id }}" method="POST">
                  @csrf
                  @method('PUT')
                  <button type="submit" class="btn btn-outline-success">Approve</button>
                  </form>
                  
                </div>
              </div>
            </div>
          </div>
        @empty
            <h3 class="d-flex justify-content-center">There is no order to be approved</h3>
        @endforelse
    </table>
</div>


@endsection