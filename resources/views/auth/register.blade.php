@extends('layouts.master2')
@section('title')
    register
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login_register.css') }}">
@endsection
@section('content')

    <div class="wrapper">
        <div class="form-box">

            <div class="register-container" id="Register">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="top">
                        <span>already Have an account ? <a href="{{ route('login') }}">login</a></span>
                        <div class="head">Sign Up</div>
                    </div>

                    <div class="input-box">
                        <input id="name" type="text" class="input-field @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="name" >
                        <i class="fa-solid fa-user"></i>
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="input-box">
                        <input id="email" type="email" class="input-field @error('email') is-invalid @enderror"name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="email">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="input-box">
                        <input id="password" type="password" class="input-field @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="password">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="input-box">
                        <input id="password-confirm" type="password" class="input-field" name="password_confirmation"required autocomplete="new-password" placeholder="confirm password">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div class="input-box">
                        <input type="submit" class="submit" value="Register">
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
