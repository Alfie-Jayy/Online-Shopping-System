@extends('admin.layouts.main')

@section('myContent')

    <!-- MAIN CONTENT-->
    <div class="main-content">


        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12">
                        {{-- After Changing the Password --}}
                        @if (session('SuccessMsg'))
                        <div class="alert alert-success d-flex justify-content-between" role="alert">

                            <p> {{session('SuccessMsg')}} </p>

                            <div class="d-flex">

                                <div class="me-3">
                                    <a href=" {{route('category#list')}} ">
                                        <button class="btn btn-sm btn-primary">Yes</button>
                                    </a>
                                </div>

                                <div>
                                    <form action=" {{route('logout')}} " method="post">
                                        @csrf
                                        <a>
                                            <button type="submit" class="btn btn-sm btn-secondary">No</button>
                                        </a>
                                    </form>
                                </div>
                            </div>

                        </div>
                    @endif
                    </div>

                    <div class="col-8 offset-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title row py-2">
                                    <div class="col-2"><a href=" {{route('product#listPage')}} "><i class=" text-black fa-solid fa-arrow-left-long fa-lg"></i></a></div>
                                    <h3 class="col-8 text-center title-2">Change Password</h3>
                                </div>
                                <hr>
                                <div class="px-5">
                                    <form action=" {{route('admin#changePassBtn')}} " method="post" novalidate="novalidate">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="currentPassword" class="control-label mb-1">Current Password</label>
                                            <input id="currentPassword" name="currentPassword" type="password" class="form-control @if(session('PassChangeError')) is-invalid @endif  @error('currentPassword') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false">
                                            @error('currentPassword')
                                                <div class="invalid-feedback"> {{$message}} </div>
                                            @enderror
                                            @if (session('PassChangeError'))
                                                <div class="invalid-feedback"> {{session('PassChangeError')}} </div>
                                            @endif
                                        </div>

                                        <div class="my-3">
                                            <label for="newPassword" class="control-label mb-1">New Password</label>
                                            <input id="newPassword" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror "
                                                aria-required="true" aria-invalid="false">
                                            @error('newPassword')
                                                <div class="invalid-feedback"> {{$message}} </div>
                                            @enderror
                                        </div>


                                        <div class="my-3">
                                            <label for="confirmNewPassword" class="control-label mb-1">Confirm New Password</label>
                                            <input id="confirmNewPassword" name="confirmNewPassword" type="password" class="form-control @error('confirmNewPassword') is-invalid @enderror "
                                                aria-required="true" aria-invalid="false">
                                            @error('confirmNewPassword')
                                                <div class="invalid-feedback"> {{$message}} </div>
                                            @enderror
                                        </div>


                                        <div class="my-3">
                                            <button id="confirm-button" type="submit" class="btn btn-primary btn-block">
                                                <div id="confirm-button-amount"><i class="fa-solid fa-circle-check me-2"></i>Confirm</div>
                                            </button>
                                        </div>
                                    </form>
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
