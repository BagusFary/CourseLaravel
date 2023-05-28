@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Approved Orders</h2>

    {{ $dataOrder }}
    @if(Session::has('delete-message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-regular fa-circle-check fa-xl"></i><strong> {{ Session::get('delete-message') }}</strong>
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

              <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteOrder-{{ $item->id }}">
                  <i class="fa-solid fa-xmark"></i>
              </button>          

       
            </td>
        </tr>

          <div class="modal fade" id="deleteOrder-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Order</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Name : {{ $item->user->name }}
                    <br>
                    Product :{{ $item->course->title }}
                    <br>
                    Price : Rp.{{ number_format($item->price,2,',','.'); }}
                    <br>
                    Status : {{ $item->status }}
                    <br>
                  <p class="lead">Deleting this order will also delete the invoice.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <form action="/cancel/{{ $item->id }}" method="POST">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-outline-danger">Delete This Order</button>
                  </form>
                  
                </div>
              </div>
            </div>
          </div>
        @empty
            <h3 class="d-flex justify-content-center">There is no approved order.</h3>
        @endforelse
    </table>
</div>


@endsection