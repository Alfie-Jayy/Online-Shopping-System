@extends('admin.layouts.main')

@section('myContent')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">

                    <!-- DATA TABLE -->
                    <div class="row d-flex justify-content-between">

                        <div class="col-lg-2 mb-3"><a href="{{route('admin#orderList')}}"><i class=" text-black fa-solid fa-arrow-left-long fa-lg"></i></a></div>

                        {{-- Order Details --}}
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="">Order Details <i class="fa-solid fa-clipboard-list ms-2"></i></h4>
                                    <hr>
                                    <div class="mt-3">

                                        <div class="row mb-3">
                                            <h6 class="col">Customer ID </h6>
                                            <h6 class="col">{{$details[0]->user_id}}</h6>
                                        </div>

                                        <div class="row mb-3">
                                            <h6 class="col">Customer Name </h6>
                                            <h6 class="col">{{$details[0]->customer_name}}</h6>
                                        </div>

                                        <div class="row mb-3">
                                            <h6 class="col">Order Code </h6>
                                            <h6 class="col">{{$details[0]->order_code}}</h6>
                                        </div>

                                        <div class="row mb-3">
                                            <h6 class="col"> Order Date </h6>
                                            <h6 class="col">{{$details[0]->created_at->format('M d, Y')}}</h6>
                                        </div>

                                        <div class="row mb-3">
                                            <h6 class="col"> Status </h6>
                                            <div class="col">
                                                @if ($order->status== '0')
                                                    <h6 class="mb-3">Pending</h6>
                                                @elseif ($order->status== '1')
                                                    <h6 class="mb-3">Accepted</h6>
                                                @elseif ($order->status== '2')
                                                    <h6 class="mb-3">Rejected</h6>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <h6 class="col"> Order Amount</h6>
                                            <h6 class="col">{{$order->total_price - 3000}} Kyats (including charges)</h6>
                                        </div>

                                        <div class="row mb-3">
                                            <h6 class="col"> Delivery</h6>
                                            <h6 class="col">3000 Kyats</h6>
                                        </div>

                                        <hr>

                                        <div class="row mb-3">
                                            <h6 class="col"> Total Amount </h6>
                                            <h6 class="col">{{$order->total_price}} Kyats</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="table-responsive">

                        <table class="table table-data2 text-center">

                            <thead>
                                <tr>
                                    <th class="align-middle">Order ID</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                                <tr class="spacer"></tr>
                            </thead>

                            <tbody id="dataList">
                                @foreach ($details as $detail)
                                    <tr>
                                        <td class="align-middle">{{$detail->id}}</td>
                                        <td class="col-1"><img src="{{asset('storage/'.$detail->product_image)}}" alt=""></td>
                                        <td class="align-middle">{{$detail->product_name}}</td>
                                        <td class="align-middle">{{$detail->product_price}} Kyats</td>
                                        <td class="align-middle">{{$detail->qty}}</td>
                                        <td class="align-middle">{{$detail->total}} Kyats</td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>


                    <!-- END DATA TABLE -->

                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

