@extends('user.layouts.main')

@section('Content')
    <!-- Cart Start -->
    <div class="container-fluid" style="height: 400px">
        <div class="row px-xl-5 ">

            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ( $orders as $order)
                            <tr>
                                <td> {{$order->created_at->format('M-d-Y')}} </td>
                                <td>{{$order->order_code}}</td>
                                <td>{{$order->total_price}}</td>
                                <td>
                                    @if ($order->status == "0")
                                        <span class="text-warning">Pending</span>
                                    @elseif ($order->status == "1")
                                        <span class="text-success">Accepted</span>
                                    @elseif ($order->status == "2")
                                        <span class="text-warning">Rejected</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $orders->links()}}
                </div>
            </div>

        </div>
    </div>
    <!-- Cart End -->
@endsection



