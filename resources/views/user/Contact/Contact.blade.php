@extends('user.layouts.main')

@section('Content')
    <div class="container-md" style="height: 600px">

        <div class="row mb-2">
            <div class="col-5 offset-7">
                @if (session('successMsg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span> {{session('successMsg')}} </span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">

            <div class="col-7 p-5" style="background-color: rgb(224, 224, 224)">

                <div class="d-flex justify-content-between">
                    <h4>Send Us Message</h4>
                    <div><i class="fa-regular fa-2xl fa-paper-plane" style="color: #127075;"></i></div>
                </div>

                <form action="{{route('user#contactSubmit')}}" method="post">
                    @csrf
                    <div class="row my-3">
                        <div class="col">
                            <label for="" class="form-label">Your Name</label>
                            <input name="username" type="text" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" required>
                        </div>
                    </div>
                    <textarea name="message" class="form-control" rows="7" placeholder="Enter your message..." required></textarea>
                    <div class="text-end">
                        <button class="btn btn-secondary mt-3" type="submit">Send</button>
                    </div>
                </form>


            </div>

            <div class="col-5 p-4 bg-secondary">
                <div class=" mt-3 mb-5">
                    <h4 class="text-white">Contact Information</h4>
                </div>
                <div class="mb-5 text-white">
                    <p class="mb-4"><i class="fa-solid fa-location-dot me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-4"><i class="fa-solid fa-envelope me-3"></i>info@example.com</p>
                    <p class="mb-4"><i class="fa-solid fa-phone me-3"></i>+012 345 67890</p>
                </div>
                <div class="">
                    <h6 class="text-white text-uppercase mt-4 mb-3">Follow Us</h6>
                    <div class="d-flex">
                        <a class="btn mr-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
