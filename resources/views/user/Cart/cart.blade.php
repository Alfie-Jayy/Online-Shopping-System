@extends('user.layouts.main')

@section('Content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">

            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($orders as $order)


                            <tr>

                                <td class="align-middle"><img src=" {{asset('storage/'.$order->product_image)}} " alt="" style="width: 50px;">
                                    <input type="hidden" name="" id="userID" value="{{$order->user_id}}">
                                    <input type="hidden" name="" id="productID" value="{{$order->product_id}}">
                                    <input type="hidden" name="" id="cartID" value="{{$order->id}}">
                                </td>
                                <td class="align-middle">
                                    {{ $order->product_name }} </td>
                                <td class="align-middle" id="pizzaPrice">{{ $order->product_price }} Kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input id="qty" type="text"
                                            class="form-control form-control-sm bg-secondary-subtle border-0 text-center"
                                            value="{{ $order->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>

                                <td id="total" class="align-middle">{{ $order->product_price * $order->qty }} Kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="position-relative text-uppercase mb-3 p-3 fw-bolder bg-secondary-subtle"><span class="pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{ $totalPrice }} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between my-3">
                            <h5>Total</h5>
                            <h5 id="finalTotalPrice">{{ $totalPrice + 3000 }} Kyats</h5>
                        </div>
                        <button id="orderBtn" class="btn btn-block btn-success font-weight-bold my-2 py-2">Proceed To Checkout</button>
                        <button id="clearBtn" class="btn btn-block btn-danger font-weight-bold my-2 py-2">Clear All Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')

    <script src="{{asset('JS/cart.js')}}" ></script>

    {{-- Single Remove Btn --}}
    <script>
            $('.btnRemove').click(function() {
                $parentNode = $(this).parents("tr");
                $parentNode.remove();

                $totalPrice = 0;

                $('#dataTable tbody tr').each(function(index,row) {

                    $totalPrice += Number($(row).find('#total').text().replace("Kyats", ""));

                    $('#subTotalPrice').html(`${$totalPrice} Kyats`);
                    $('#finalTotalPrice').html(`${$totalPrice + 3000 }Kyats`);

                })

                //removing at database

                $cartID = $parentNode.find("#cartID").val();

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/cart/single/remove',
                    data: {'cartID' : $cartID},
                    dataType: 'json',
                    success : function(response){
                        // console.log(response);
                    }
                })


            })
    </script>

    {{-- Clear Btn --}}
    <script>
        $(document).ready(function(){
            $('#clearBtn').click(function(){

                $cart = $('#dataTable tbody tr');

                //clearing at Client Site
                $($cart).remove();

                //clearing at Database (server site)
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/cart/clear',
                    dataType: 'json',
                    success : function(response){
                        // console.log(response);
                    }
                })


            })
        })
    </script>


    {{-- Clikced order --}}
    <script>
        $(document).ready(function() {
            $('#orderBtn').click(function(){

                $orderList = [];

                $random = Math.floor(Math.random()*100000000001);
                // $finalTotal = Number($('#finalTotalPrice').text().replace('Kyats',""));


                $('#dataTable tbody tr').each(function(index,row){
                    $orderList.push({
                        'user_id' : $(row).find('#userID').val(),
                        'product_id' : $(row).find('#productID').val(),
                        'qty' : $(row).find('#qty').val(),
                        'total' : Number($(row).find('#total').text().replace('Kyats',"")),
                        // 'finalTotal' : $finalTotal,
                        'order_code' : 'POS_'+ $random
                    });
                });

                console.log($orderList);

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/cart/order',
                    data: Object.assign({}, $orderList),
                    dataType: 'json',
                    success : function(response){

                        // console.log(response);
                        if(response.status == 'true'){
                            window.location.href = "http://127.0.0.1:8000/user/shop";
                        }
                    }
                })

            });
        })
    </script>

@endsection


