@extends('layouts.master2')
@section('title')
    login
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login_register.css') }}">
@endsection
@section('content')

    <div class="wrapper">

        <div class="form-box">
            <!----login form-->
            <div class="login-container" id="login">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="top">
                        @if ($type == 'user')
                        <span> Don't have an account ? <a href="{{route('user.create')}}" >Sign Up</a></span>

                        <div class="head">Login as user</div>

                        @elseif($type == 'author')
                        <span> Don't have an account ? <a href="{{route('author.create')}}" >Sign Up</a></span>

                        <div class="head">Login as author</div>

                        @elseif($type == 'bookstore')
                        <span> Don't have an account ? <a href="{{route('bookstore.create')}}" >Sign Up</a></span>

                        <div class="head">Login as bookstore</div>

                        @else


                        <div class="head">Login as admin</div>

                        @endif
                    </div>
                    @if (\Session::has('message'))
                    <div class="alert alert-danger text-center">
                     <p>{!! \Session::get('message') !!}</p>
                    </div>
                @endif


                    <div class="input-box">
                        <input  class="input-field @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder=" Email">
                        <i class="fa-solid fa-user"></i>
                        <input type="hidden" value="{{$type}}" name="type">
                        @error('email')
                        <span class="invalid-feedbackk" >
                          {{ $message }}
                        </span>
                    @enderror
                    </div>

                    <div class="input-box">
                        <input type="password" class="input-field @error('password') is-invalid @enderror" name="password"
                            autocomplete="current-password" placeholder="password">
                        <i class="fa-solid fa-lock"></i>
                        @error('password')
                        <span class="invalid-feedbackk" >
                          {{ $message }}
                        </span>
                    @enderror
                    </div>

                    <div class="input-box">
                        <input type="submit" class="submit" value="Sign in">
                    </div>
                    <div class="two-col">
                        {{-- <div class="one">
                            <input type="checkbox" id="login" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label for="login">Remember me</label>
                        </div>
                        <div class="two">
                            @if (Route::has('password.request'))
                                <label><a href="{{ route('password.request') }}"> Forget password ?</a></label>
                            @endif
                        </div> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
