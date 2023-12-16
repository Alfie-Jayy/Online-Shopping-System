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
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href=" {{ route('category#cratePage') }} ">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add item
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    <div class="my-4 d-flex justify-content-between">

                        <div class="">
                            <h2 class="title-3">Total Categories - {{ $categories->total() }} </h2>
                        </div>


                        <div class="">
                            <form class="form-header" action="" method="get">
                                <input class="au-input au-input--xl" type="text" value="{{ request('search') }}"
                                    name="search" placeholder="Search for datas &amp; categories..." />
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
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <p class="text-danger"> {{ session('deleteSuccess') }} </p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('updateSuccess'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <p class="text-success"> {{ session('updateSuccess') }} </p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif




                    @if (count($categories) != 0)
                        <div class="table-responsive table-responsive-data2">

                            <table class="table table-data2">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Created Date</th>
                                        <th></th>
                                    </tr>
                                    <tr class="spacer"></tr>
                                </thead>

                                @foreach ($categories as $category)
                                    <tbody>

                                        <tr class="tr-shadow">
                                            <td> {{ $category->id }} </td>
                                            <td class="desc"> {{ $category->name }} </td>
                                            <td>{{ $category->created_at->format('M-d-Y H:i:A') }}</td>
                                            <td>
                                                <div class="table-data-feature">

                                                    <a href=" {{ route('category#editPage', $category->id) }} ">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>

                                                    <a href=" {{ route('category#delete', $category->id) }} ">
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

                        </div>
                        <!-- END DATA TABLE -->

                    @else
                        <h4 class="text-center text-secondary mt-5">Sorry, No Category for your search!</h4>
                    @endif



                    <div class="mt-3">
                        {{ $categories->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
