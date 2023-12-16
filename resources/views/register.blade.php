@extends('layouts.main')

@section('title', 'register')

@section('myContent')

    <div class="">

        <form action="{{ route('register') }}" method="post">

            @csrf

            <div class="form-group">
                <label>Username</label>
                <input class="au-input au-input--full" type="text" name="name" placeholder="Username">
                @error('name')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>


            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                @error('email')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>


            <div class="form-group">
                <label>Phone</label>
                <input class="au-input au-input--full" type="text" name="phone" placeholder="09******">
                @error('phone')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Gender</label>
                <select name="gender" id="gender" class="form-select">
                    <option value="male">male</option>
                    <option value="female">female</option>
                </select>
                @error('gender')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>


            <div class="form-group">
                <label>Address</label>
                <input class="au-input au-input--full" type="text" name="address" placeholder="address">
                @error('address')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                @error('password')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>


            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password_confirmation"
                    placeholder="Confirm Password">
                @error('password_confirmation')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

        </form>

        <div class="register-link">
            <p>
                Already have account?
                <a href="{{ route('auth#loginPage') }}">Sign In</a>
            </p>
        </div>

    </div>
@endsection
