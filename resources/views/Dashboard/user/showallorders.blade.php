@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Your Order List</h2>
    <table class="table table-secondary table-striped">
        <tr>
            <th>No</th>
            <th>Product</th>
            <th>Price</th>
            <th>Status</th>
        </tr>
        @forelse ($dataOrder as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->course->title }}</td>
            <td>Rp.{{ number_format($item->price,2,',','.'); }}</td>
            <td>{{ $item->status }}</td>
        </tr>
        @empty
            <h3 class="d-flex justify-content-center">There is no order</h3>
        @endforelse
    </table>
</div>


@endsection