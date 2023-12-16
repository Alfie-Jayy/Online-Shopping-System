@extends('admin.layouts.main')

@section('myContent')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-8 offset-lg-2 col-10 offset-1">
                    <div class="card">
                        <div class="card-body">

                            {{-- Title --}}
                            <div class="card-title row py-2">
                                <div class="col-2"><a href=" {{route('product#listPage')}} "><i class=" text-black fa-solid fa-arrow-left-long fa-lg"></i></a></div>
                                <h3 class="col-8 text-center title-2">Product Creation</h3>
                            </div>
                            <hr>

                            {{-- Form for creation --}}
                            <form action=" {{route('product#createBtn')}}" enctype="multipart/form-data" method="post" novalidate="novalidate">
                                @csrf

                                <div class="mb-3">
                                    <label for="pizzaName" class="control-label mb-1">Name</label>
                                    <input id="pizzaName" name="pizzaName" value="{{old('pizzaName')}}" type="text" class="form-control  @error('pizzaName') is-invalid @enderror "aria-required="true" aria-invalid="false" placeholder="Enter Product Name">
                                    @error('pizzaName')
                                        <span class="invalid-feedback"> {{$message}} </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="pizzaCategory" class="control-label mb-1">Category</label>
                                    <select name="pizzaCategory" id="pizzaCategory" class="form-select @error('pizzaCategory') is-invalid @enderror">
                                        <option value="">Choose Category</option>
                                        @foreach ($products as $product)
                                            <option value= {{$product->id}} >{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('pizzaCategory')
                                        <span class="invalid-feedback"> {{$message}} </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="pizzaDescription" class="control-label mb-1">Description</label>
                                    <textarea name="pizzaDescription" id="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" placeholder="Enter description">{{old('pizzaDescription')}}</textarea>
                                    @error('pizzaDescription')
                                        <span class="invalid-feedback"> {{$message}} </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="pizzaImage" class="control-label mb-1">Image</label>
                                    <input type="file" name="pizzaImage" id="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror">
                                    @error('pizzaImage')
                                        <span class="invalid-feedback"> {{$message}} </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="pizzaWaitingTime" class="control-label mb-1">Waiting Time</label>
                                    <input type="text" name="pizzaWaitingTime" value="{{old('pizzaWaitingTime')}}" id="pizzaWaitingTime" class="form-control @error('pizzaImage') is-invalid @enderror" placeholder="Enter waiting time">
                                    @error('pizzaWaitingTime')
                                        <span class="invalid-feedback"> {{$message}} </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="pizzaPrice" class="control-label mb-1">Price</label>
                                    <input id="pizzaPrice" name="pizzaPrice" value="{{old('pizzaPrice')}}" type="text" class="form-control @error('pizzaPrice') is-invalid @enderror "aria-required="true" aria-invalid="false" placeholder="Enter Price">
                                    @error('pizzaPrice')
                                        <span class="invalid-feedback"> {{$message}} </span>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-md btn-primary btn-block">
                                        <i class="fa-regular fa-circle-check me-2"></i>
                                        <span id="payment-button-amount">Create</span>
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
