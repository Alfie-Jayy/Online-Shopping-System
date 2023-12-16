@extends('user.layouts.main')

@section('Content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Category Start -->

                <h5 class="text-uppercase mb-3">Filter by Categories</h5>

                <div class="bg-light p-4 mb-30">

                    <form>

                        <div
                            class="d-flex align-items-center justify-content-between mb-3 bg-secondary text-white p-2 rounded-sm shadow">
                            <label class="form-check-label" for="price-all">All Categories</label>
                            <span class="badge bg-dark border font-weight-normal text-white">{{ count($categories) }} </span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href=" {{ route('user#shop') }} " class="text-decoration-none">
                                <label class="form-label text-dark">All</label>
                            </a>
                        </div>
                        @foreach ($categories as $category)
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href=" {{ route('user#categoryFilter', $category->id) }} " class="text-decoration-none">
                                    <label class=" form-label text-dark">{{ $category->name }}</label>
                                </a>
                            </div>
                        @endforeach

                    </form>
                </div>
                <!-- Category End -->

            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">

                            <div class="d-flex">
                                <div>
                                    <a href=" {{route('user#cartList')}}">
                                        <button type="button" class="btn btn-sm btn-dark position-relative me-4">
                                            <i class="fa-solid fa-cart-shopping text-white"></i> Cart
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                {{count($cart)}}
                                            </span>
                                        </button>
                                    </a>
                                </div>

                                <div>
                                    <a href=" {{route('user#orderList')}}">
                                        <button type="button" class="btn btn-sm btn-dark position-relative me-4">
                                            <i class="fa-solid fa-truck"></i> Orders
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                {{count($orders)}}
                                            </span>
                                        </button>
                                    </a>
                                </div>
                            </div>

                            <div class="ml-2 me-4 d-flex">
                                <div class="btn-group">
                                    <select class="form-select" name="sorting" id="sortingOption">
                                        <option value="">Sorting</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row" id="dataList">

                        @if (count($products) != 0)
                            @foreach ($products as $product)
                                <div class="col-lg-3 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100"
                                                src=" {{ asset('storage/' . $product->image) }}" style="height: 200px">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square addCartBtn"><i class="fa fa-shopping-cart"></i></a>
                                                <input type="hidden" class="productId" value={{$product->id}}>
                                                <input type="hidden" class="userId" value={{Auth::user()->id}}>
                                                <a class="btn btn-outline-dark btn-square" href=" {{route('user#productDetail',$product->id )}} "><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">
                                                {{ $product->name }} </a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <p>{{ $product->price }} Kyats</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h4 class="text-center mt-3">Sorry! The products of {{$selectedCategory}} are not avaiable right now </h4>
                        @endif


                    </div>

                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
    </div>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

            //sorting
            $('#sortingOption').change(function() {
                $eventOption = $('#sortingOption').val();
                // console.log($eventOption);

                if ($eventOption == 'asc') {


                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/products/sort',
                        data: {
                            'status': 'asc'
                        },
                        dataType: 'json',

                        success: function(response) {

                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4" id="myForm">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 200px" src=" {{ asset('storage/${response[$i].image}') }} " alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" ><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" ><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href=""> ${response[$i].name} </a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <p>${response[$i].price} Kyats</p>
                                </div>
                            </div>
                        </div>
                    </div>`;
                            }
                            $('#dataList').html($list);

                        }
                    })

                } else if ($eventOption == 'desc') {


                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/products/sort',
                        data: {
                            'status': 'desc'
                        },
                        dataType: 'json',

                        success: function(response) {
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4" id="myForm">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 200px" src=" {{ asset('storage/${response[$i].image}') }} " alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href=""> ${response[$i].name} </a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <p>${response[$i].price} Kyats</p>
                                </div>
                            </div>
                        </div>
                    </div>`;
                            }
                            $('#dataList').html($list);
                        }
                    })

                }

            })

            //Add cart
            $('.addCartBtn').click(function() {

                $userId = $(this).siblings('.userId').val();
                $productId = $(this).siblings('.productId').val();

                $source = {
                    'userId': $userId,
                    'productId': $productId
                };

                console.log($source);

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/cart/singleAdd',
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

        })
    </script>
@endsection
