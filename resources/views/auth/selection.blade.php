@extends('layouts.master2')

@section('title')
    login as what
@endsection


@section('content')
    <div class="selectionbox">
        <div class="selection col-lg-6 container-fluid">
            <h1>login as what?</h1>
            <div class="row">
                <div class="select col-lg-3">
                    <a href="{{ route('login.show', 'admin')}}" >
                        <img src="{{asset('assets/img/users/admin.png')}}"title="admin" alt="">

                    </a>
                    <p>admin</p>
                </div>
                <div class="select col-lg-3 ">
                    <a href="{{ route('login.show', 'user')}}" >
                        <img src="{{asset('assets/img/users/user.png')}}" title="user" alt="">

                    </a>
                    <p>user</p>
                </div>
                <div class="select col-lg-3">
                    <a href="{{ route('login.show', 'author')}}">
                        <img src="{{asset('assets/img/users/author.png')}}" title="author" alt="">
                    </a>
                    <p>author</p>
                </div>
                <div class="select col-lg-3">
                    <a href="{{ route('login.show', 'bookstore')}}">
                        <img src="{{asset('assets/img/users/bookstore.png')}}"title="bookstore" alt="">
                    </a>
                    <p>bookstore</p>
                </div>


            </div>
        </div>
    </div>


    {{-- <section class="height-100vh d-flex align-items-center page-section-ptb login"
            style="background-image: url('{{ asset('assets/images/sativa.png') }}');">
            <div class="container">
                <div class="row justify-content-center no-gutters vertical-align">

                    <div style="border-radius: 15px;" class="col-lg-8 col-md-8 bg-white">
                        <div class="login-fancy pb-40 clearfix">
                            <h3 style="font-family: 'Cairo', sans-serif" class="mb-30">حدد طريقة الدخول</h3>
                            <div class="form-inline">
                                <a class="btn btn-default col-lg-3" title="طالب"
                                    href=" }}">
                                    <img alt="user-img" width="100px;" src="{{ URL::asset('assets/images/student.png') }}">
                                </a>
                                <a class="btn btn-default col-lg-3" title="ولي امر"
                                    href="{{ route('login.show', 'parent') }}">
                                    <img alt="user-img" width="100px;" src="{{ URL::asset('assets/images/parent.png') }}">
                                </a>
                                <a class="btn btn-default col-lg-3" title="معلم"
                                    href="{{ route('login.show', 'teacher') }}">
                                    <img alt="user-img" width="100px;" src="{{ URL::asset('assets/images/teacher.png') }}">
                                </a>
                                <a class="btn btn-default col-lg-3" title="ادمن" href="{{ route('login.show', 'admin') }}">
                                    <img alt="user-img" width="100px;" src="{{ URL::asset('assets/images/admin.png') }}">
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
@endsection
