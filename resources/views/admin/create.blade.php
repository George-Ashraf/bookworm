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
                <form method="POST" action="{{ route('admin.store') }}">
                    @csrf
                    <div class="top">
                        <span>already Have an account ? <a href="{{ route('selection') }}">login</a></span>
                        <div class="head">add admin</div>
                    </div>

                    <div class="input-box">
                        <input id="name" type="text" class="input-field @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="name" >
                        <i class="fa-solid fa-user"></i>
                        @error('name')
                        <span class="invalid-feedbackk" >
                            {{ $message }}
                        </span>
                    @enderror






                    
                    </div>






                    <div class="input-box">
                        <input class="@error('email') is-invalid @enderror input-field "name="email" value="{{ old('email') }}"   placeholder="email">
                        <i class="fa-solid fa-envelope"></i>
                        @error('email')
                    <span class="invalid-feedbackk">
                        {{$message}}

                    </span>

                    @enderror
                    </div>

                    <div class="input-box">
                        <input id="password" type="password" class="input-field @error('password') is-invalid @enderror" name="password"  value="{{ old('password') }}"  autocomplete="new-password" placeholder="password">
                        <i class="fa-solid fa-lock"></i>
                        @error('password')
                        <span class="invalid-feedbackk" >
                            {{ $message }}
                        </span>
                    @enderror
                    </div>

                    <div class="input-box">
                        <input id="password-confirm" type="password" class="@error('confirm_password') is-invalid @enderror input-field" name="confirm_password" value="{{ old('confirm_password') }}"  autocomplete="new-password" placeholder="confirm password">
                        <i class="fa-solid fa-lock"></i>
                        @error('confirm_password')
                        <span class="invalid-feedbackk" >
                            {{ $message }}
                        </span>
                    @enderror
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
