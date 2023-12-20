@extends('user.layouts.main')

@section('Content')
    <!-- Shop Detail Start -->
    <div class="container-xl px-5 pb-5">
        <div class="row px-xl-5">

            <div class="mb-4"><a href="{{ route('user#shop') }}"><i class=" text-black fa-solid fa-arrow-left-long fa-lg"></i></a></div>

            <div class="col-lg-5 mb-30">
                <img class="w-100 shadow-lg" src="{{ asset('storage/' . $pizza->image) }}" alt="Image">
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3> {{ $pizza->name }} </h3>
                    <div class="d-flex mb-3">
                        <small class="pt-1">{{ $pizza->view_count + 1}} views</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $pizza->price }} Kyats</h3>
                    <p class="mb-4"> {{ $pizza->description }} </p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">

                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>

                            <input type="text" class="form-control bg-secondary-subtle border-0 text-center"
                              value="1" id="orderCount">

                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>

                        </div>
                        <button type="button" class="btn btn-primary px-3" id="addCartBtn"><i
                                class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>

                    <input type="hidden" id="pizzaId" value="{{ $pizza->id }}">
                    <input type="hidden" id="userId" value="{{ Auth::user()->id }} ">

                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-xl px-5">
        <h4 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary-subtle p-1">You
                May Also Like</span></h4>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($products as $product)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid" src=" {{ asset('storage/' . $product->image) }}" alt=""
                                    style="height: 150px">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square"
                                        href=" {{ route('user#productDetail', $product->id) }} "><i
                                            class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href=""> {{ $product->name }} </a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5> {{ $product->price }} Kyats</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

            // Add Cart
            $('#addCartBtn').click(function() {

                $source = {
                    'count': $('#orderCount').val(),
                    'userId': $('#userId').val(),
                    'pizzaId': $('#pizzaId').val()
                };

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/cart/add',
                    data: $source,
                    dataType: 'json',

                    success: function(response) {
                        console.log(response);
                        if (response.status == "success") {
                            window.location.href = "http://127.0.0.1:8000/user/shop";
                        }
                    }

                })


            })

            // View
            $productID = $('#pizzaId').val();

            $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/product/viewCounts',
                    data: {'productID' : $productID},
                    dataType: 'json'

                })


        })
    </script>
@endsection
