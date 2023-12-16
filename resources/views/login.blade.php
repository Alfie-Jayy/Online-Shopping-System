@extends('layouts.main')

@section('title', 'login')

@section('myContent')
    <div class="login-form">

        <form action= "{{ route('login') }}" method="post">

            @csrf

            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full @error('email') is-invalid @enderror " type="email" name="email" placeholder="Email">
                @error('email')
                    <span class="invalid-feedback"> {{ $message }} </span>
                @enderror
            </div>


            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" @error('password') is-invalid @enderror type="password" name="password" placeholder="Password">
                @error('password')
                    <span class="invalid-feedback"> {{ $message }} </span>
                @enderror
            </div>

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>

        </form>
        <div class="register-link">
            <p>
                Don't you have account?
                <a href="{{ route('auth#registerPage') }}">Sign Up Here</a>
            </p>
        </div>
    </div>
@endsection
