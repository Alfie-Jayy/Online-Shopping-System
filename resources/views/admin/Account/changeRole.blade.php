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
                                <div class="col-2"><a href=" {{route('admin#list')}} "><i class=" text-black fa-solid fa-arrow-left-long fa-lg"></i></a></div>
                                <h3 class="col-8 text-center title-2">Change Role</h3>
                            </div>
                            <hr>

                            <form action=" {{ route('admin#changeRoleBtn', $account->id) }} " method="post" enctype="multipart/form-data" >
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 offset-lg-1">

                                        <div class="my-3">
                                            @if ($account->image)
                                                <img src="{{asset('storage/'.$account->image)}}" alt="">
                                            @else
                                                @if ($account->gender == 'male')
                                                    <img src="{{asset('Image/male_profile.png')}}" alt="">
                                                @else
                                                    <img src="{{asset('Image/female_profile.jpg')}}" alt="">
                                                @endif
                                            @endif
                                        </div>

                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-sm btn-primary">Change</button>
                                        </div>

                                    </div>
                                    <div class="col-lg-5">

                                        <div class="my-4">
                                            <label for="" class="form-label">Username:</label>
                                            <input type="text" disabled value="{{ old('name', $account->name) }}"
                                                name="name" id=""
                                                class="form-control">
                                        </div>

                                        <div class="my-4">
                                            <label for="" class="form-label">Role:</label>
                                            <select name="role" class="form-select">
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>

                                        <div class="my-4">
                                            <label for="" class="form-label">Email:</label>
                                            <input type="email" disabled value="{{ old('email', $account->email) }}"
                                                name="email" id=""
                                                class="form-control ">
                                        </div>

                                        <div class="my-4">
                                            <label for="" class="form-label">Phone:</label>
                                            <input type="text" disabled value="{{ old('phone', $account->phone) }}"
                                                name="phone" id=""
                                                class="form-control">
                                        </div>

                                        <div class="my-4">
                                            <label for="gender" class="form-label">Gender:</label>
                                            <select name="gender" disabled id="gender" class="form-select">
                                                <option @if ($account->gender == 'male') selected @endif value="male">
                                                    male
                                                </option>
                                                <option @if ($account->gender == 'female') selected @endif value="female">
                                                    female
                                                </option>
                                            </select>
                                        </div>

                                        <div class="my-4">
                                            <label for="" class="form-label">Address:</label>
                                            <textarea name="address" disabled id="" class="form-control">{{ old('address', $account->address) }}</textarea>
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
