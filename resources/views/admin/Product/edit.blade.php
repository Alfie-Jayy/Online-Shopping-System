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
                                <div class="col-2"><a href=" {{route('product#listPage')}} "><i class=" text-black fa-solid fa-arrow-left-long fa-lg"></i></a></div>
                                <h3 class="col-8 text-center title-2">Edit Pizza Details</h3>
                            </div>
                            <hr class="mb-4">

                            <form action=" {{ route('product#confirmBtn') }} " method="post" enctype="multipart/form-data" >
                                @csrf

                                <div class="row">

                                    <div class="col-lg-4 offset-lg-1">

                                        <input type="hidden" name="productID" value={{$product->id}}>

                                        <div class="my-3">
                                            <img src=" {{ asset('storage/'.$product->image)}} " alt="">
                                        </div>

                                        <div class="my-3">
                                            <input class="form-control @error('pizzaImage') is-invalid @enderror" type="file" name="pizzaImage" id="">
                                            @error('pizzaImage')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>


                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-sm btn-primary">Confirm</button>
                                        </div>

                                    </div>

                                    <div class="col-lg-6">

                                            <div class="mb-3">
                                                <label for="pizzaName" class="control-label mb-1">Name</label>
                                                <input id="pizzaName" name="pizzaName" value="{{old('pizzaName',$product->name)}}" type="text" class="form-control  @error('pizzaName') is-invalid @enderror "aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name">
                                                @error('pizzaName')
                                                    <span class="invalid-feedback"> {{$message}} </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="pizzaCategory" class="control-label mb-1">Category</label>
                                                <select name="pizzaCategory" id="pizzaCategory" class="form-select @error('pizzaCategory') is-invalid @enderror">
                                                    <option value="">Choose Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value={{$category->id}} @if($category->id == $product->category_id) selected @endif >{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('pizzaCategory')
                                                    <span class="invalid-feedback"> {{$message}} </span>
                                                @enderror
                                            </div>


                                            <div class="mb-3">
                                                <label for="pizzaDescription" class="control-label mb-1">Description</label>
                                                <textarea name="pizzaDescription" rows="10" id="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" placeholder="Enter description">{{old('pizzaDescription',$product->description)}}</textarea>
                                                @error('pizzaDescription')
                                                    <span class="invalid-feedback"> {{$message}} </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="pizzaPrice" class="control-label mb-1">Price</label>
                                                <input id="pizzaPrice" name="pizzaPrice" value="{{old('pizzaPrice',$product->price)}}" type="text" class="form-control @error('pizzaPrice') is-invalid @enderror "aria-required="true" aria-invalid="false" placeholder="Enter Price">
                                                @error('pizzaPrice')
                                                    <span class="invalid-feedback"> {{$message}} </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="pizzaWaitingTime" class="control-label mb-1">Waiting Time</label>
                                                <input type="text" name="pizzaWaitingTime" value="{{old('pizzaWaitingTime', $product->waiting_time)}}" id="pizzaWaitingTime" class="form-control @error('pizzaImage') is-invalid @enderror" placeholder="Enter waiting time">
                                                @error('pizzaWaitingTime')
                                                    <span class="invalid-feedback"> {{$message}} </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="" class="control-label mb-1">View Count</label>
                                                <input type="text" name="" disabled value="{{$product->view_count}}" id="pizzaWaitingTime" class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label for="" class="control-label mb-1">Created At</label>
                                                <input type="text" name="" disabled value="{{$product->created_at->format('d-M-Y')}}" id="pizzaWaitingTime" class="form-control">
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
