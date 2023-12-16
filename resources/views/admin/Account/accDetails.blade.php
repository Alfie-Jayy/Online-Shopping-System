@extends('admin.layouts.main')

@section('myContent')

    <!-- MAIN CONTENT-->
    <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-10 offset-1">
                        @if (session('UpdateSuccess'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span> {{session('UpdateSuccess') }} </span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="col-10 offset-1">

                        <div class="card">
                            <div class="card-body">
                                <div class="card-title row py-2">
                                    <div class="col-2"><a href=" {{route('category#list')}} "><i class=" text-black fa-solid fa-arrow-left-long fa-lg"></i></a></div>
                                    <h3 class="col-8 text-center title-2">Personal Details</h3>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="my-3">
                                            @if (Auth::user()->image)
                                                <img src="{{asset('storage/'.Auth::user()->image)}}" alt="">
                                            @else
                                                @if (Auth::user()->gender == 'male')
                                                    <img src="{{asset('Image/male_profile.png')}}" alt="">
                                                @else
                                                    <img src="{{asset('Image/female_profile.jpg')}}" alt="">
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="">
                                            <p class="my-3"><i class="fa-solid fa-user me-2"></i>{{Auth::user()->name}}</p>
                                            <p class="my-3"><i class="fa-solid fa-envelope me-2"></i>{{Auth::user()->email}}</p>
                                            <p class="my-3"><i class="fa-solid fa-phone me-2"></i>{{Auth::user()->phone}}</p>
                                            <p class="my-3"><i class="fa-solid fa-venus-mars me-2"></i>{{Auth::user()->gender}}</p>
                                            <p class="my-3"><i class="fa-solid fa-map-location-dot me-2"></i>{{Auth::user()->address}}</p>
                                            <p class="my-3"><i class="fa-regular fa-calendar-check me-2"></i>{{Auth::user()->created_at->format('d-M-Y')}}</p>
                                        </div>
                                        <div>
                                            <a href=" {{route('admin#editDetailsPage')}} ">
                                                <button class="btn btn-sm btn-primary">Edit Personal Details</button>
                                            </a>
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
