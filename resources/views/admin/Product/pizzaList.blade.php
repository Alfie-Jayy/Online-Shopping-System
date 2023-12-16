@extends('admin.layouts.main')

@section('myContent')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href=" {{ route('product#addPage') }} ">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add Product
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    <div class="my-4 d-flex justify-content-between">

                        <div class="">
                            <h2 class="title-3">Total Products - {{$products->total()}}  </h2>
                        </div>


                        <div class="">
                            <form class="form-header" action="" method="get">
                                <input class="au-input au-input--xl" type="text" value="{{ request('search') }}"
                                    name="search" placeholder="Search products" />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                        </div>


                    </div>

                    @if (session('createSuccess'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <p class="text-success"> {{ session('createSuccess') }} </p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('deleteSuccess'))
                        <div class="alert alert-info fade alert-dismissible show" role="alert">
                            <p class="text-primary"> {{session('deleteSuccess')}} </p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('updateSuccess'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <p class="text-success"> {{ session('updateSuccess') }} </p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif


                    @if (count($products) != 0)
                        <div class="table-responsive table-responsive-data2">

                            <table class="table table-data2">

                                <thead>
                                    <tr>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">View Count</th>
                                        <th></th>
                                    </tr>
                                    <tr class="spacer"></tr>
                                </thead>

                                @foreach ($products as $product)
                                    <tbody>

                                        <tr class="tr-shadow">
                                            <td class="col-2"><img class="img-thumbnails" src="{{asset('storage/'.$product->image)}}"></td>
                                            <td class="text-center"> {{$product->name}} </td>
                                            <td class="text-center"> {{$product->price}} </td>
                                            <td class="text-center"> {{$product->category_name}} </td>
                                            <td class="text-center"> {{$product->view_count}} </td>
                                            <td class="text-center">
                                                <div class="table-data-feature">

                                                    <a href=" {{ route('product#viewPage', $product->id) }} ">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                            title="View">
                                                            <i class="zmdi zmdi-eye"></i>
                                                        </button>
                                                    </a>

                                                    <a href=" {{ route('product#editPage', $product->id) }} ">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>

                                                    <a href=" {{ route('product#delete', $product->id) }} ">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>

                                    </tbody>
                                @endforeach

                            </table>

                            <div class="mt-3">
                                {{$products->appends(request()->query())->links()}}
                            </div>

                        </div>
                    @else
                        <h4 class="text-center text-secondary mt-5">Sorry, No Product for your search!</h4>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
