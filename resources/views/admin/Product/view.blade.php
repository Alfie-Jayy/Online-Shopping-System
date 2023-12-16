@extends('admin.layouts.main')

@section('myContent')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-10 offset-1">
                    <div class="mb-4 text-start">
                        <button class="btn btn-secondary" onclick="history.back()"><i
                                class="fa-solid fa-angles-left me-2"></i>Back</button>
                    </div>
                    @if (session('UpdateSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span> {{ session('UpdateSuccess') }} </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <div class="col-10 offset-1">

                    <div class="card">
                        <div class="card-body">

                            <div class="row p-3">

                                <div class="col-lg-4 pe-lg-4">
                                    <div class="my-3">
                                        <img class="shadow" src="{{ asset('storage/' . $product->image) }}" alt="">
                                    </div>
                                </div>

                                <div class="col-lg-8">

                                    <div class="">
                                        <h3 class="my-3">{{ $product->name }}</h3>

                                        <div class="mb-sm-3">
                                            <span class=" btn btn-sm btn-info mb-2 mb-sm-0 me-sm-2" me-sm-2><i
                                                    class="fa-solid fa-money-bill-1-wave me-2"></i>{{ $product->price }}
                                                Kyats</span>
                                            <span class="btn btn-sm btn-info mb-2 mb-sm-0 me-sm-2"><i
                                                    class="fa-regular fa-calendar-check me-2"></i>{{ $product->created_at->format('d-M-Y') }}</span>
                                            <span class=" btn btn-sm btn-info mb-2 mb-sm-0 me-sm-2"><i
                                                    class="fa-solid fa-stopwatch me-2"></i>{{ $product->waiting_time }}</span>
                                        </div>

                                        <div class="mb-3">
                                            <span class="btn btn-sm btn-info mb-2 mb-sm-0 me-sm-2"><i
                                                    class="fa-solid fa-stroopwafel me-2"></i>{{ $product->category_name }}</span>
                                            <span class=" btn btn-sm btn-info mb-2 mb-sm-0 me-sm-2"><i
                                                    class="fa-solid fa-street-view me-2"></i>{{ $product->view_count }}</span>
                                        </div>

                                        <p class="mb-3 text-muted">{{ $product->description }}</p>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- END MAIN CONTENT-->
@endsection
