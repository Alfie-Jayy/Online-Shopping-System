@extends('admin.layouts.main')

@section('myContent')
    <!-- MAIN CONTENT-->
    <div class="main-content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-10 offset-1">

                    <div class="card">
                        <div class="card-body">
                            <div class="card-title row py-2">
                                <div class="col-2"><a href=" {{route('admin#accountDetailsPage')}} "><i class=" text-black fa-solid fa-arrow-left-long fa-lg"></i></a></div>
                                <h3 class="col-8 text-center title-2">Edit Personal Details</h3>
                            </div>
                            <hr>

                            <form action=" {{ route('admin#detailsConfirmBtn')}}" method="post" enctype="multipart/form-data" >
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 offset-lg-1">

                                        <div class="my-3">
                                            @if (Auth::user()->image)
                                                <img class="img-thumbnail" src="{{asset('storage/'.Auth::user()->image)}}" alt="">
                                            @else
                                                @if (Auth::user()->gender == 'male')
                                                    <img class="img-thumbnail" src="{{asset('Image/male_profile.png')}}" alt="">
                                                @else
                                                    <img class="img-thumbnail" src="{{asset('Image/female_profile.jpg')}}" alt="">
                                                @endif
                                            @endif
                                        </div>

                                        <div class="my-3">
                                            <input class="form-control @error('image') is-invalid @enderror " type="file" name="image" id="">
                                            @error('image')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>


                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-sm btn-primary">Confirm</button>
                                        </div>

                                    </div>
                                    <div class="col-lg-5">

                                        <div class="my-4">
                                            <label for="" class="form-label">Username:</label>
                                            <input type="text" value="{{ old('name', Auth::user()->name) }}"
                                                name="name" id=""
                                                class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>

                                        <div class="my-4">
                                            <label for="" class="form-label">Email:</label>
                                            <input type="email" value="{{ old('email', Auth::user()->email) }}"
                                                name="email" id=""
                                                class="form-control  @error('email') is-invalid @enderror">
                                            @error('email')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>

                                        <div class="my-4">
                                            <label for="" class="form-label">Phone:</label>
                                            <input type="text" value="{{ old('phone', Auth::user()->phone) }}"
                                                name="phone" id=""
                                                class="form-control @error('phone') is-invalid @enderror">
                                            @error('phone')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>

                                        <div class="my-4">
                                            <label for="gender" class="form-label">Gender:</label>
                                            <select name="gender" id="gender" class="form-select">
                                                <option @if (Auth::user()->gender == 'male') selected @endif value="male">
                                                    male
                                                </option>
                                                <option @if (Auth::user()->gender == 'female') selected @endif value="female">
                                                    female
                                                </option>
                                            </select>
                                        </div>

                                        <div class="my-4">
                                            <label for="" class="form-label">Address:</label>
                                            <textarea name="address" id="" class="form-control @error('address') is-invalid @enderror">{{ old('address', Auth::user()->address) }}</textarea>
                                            @error('address')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>

                                        <div class="my-4">
                                            <label for="" class="form-label">Role:</label>
                                            <input type="text" value="{{ Auth::user()->role }}" name="role"
                                                id="" class="form-control" disabled>
                                        </div>

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- END MAIN CONTENT-->
@endsection
