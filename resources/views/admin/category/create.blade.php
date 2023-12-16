@extends('admin.layouts.main')

@section('myContent')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-8 offset-lg-2 col-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title row py-2">
                                <div class="col-2"><a href=" {{route('category#list')}} "><i class=" text-black fa-solid fa-arrow-left-long fa-lg"></i></a></div>
                                <h3 class="col-8 text-center title-2">Category Creation</h3>
                            </div>
                            <hr>
                            <form action=" {{route('category#createBtn')}} " method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group my-5">
                                    <label for="categoryName" class="control-label mb-2">Category Name</label>
                                    <input id="categoryName" name="categoryName" type="text" class="form-control @error('categoryName') is-invalid @enderror "
                                        aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                    @error('categoryName')
                                        <span class="invalid-feedback"> {{$message}} </span>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-primary btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
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
