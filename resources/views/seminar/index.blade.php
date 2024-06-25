@extends('layouts.master')
@section('title')
    seminar
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/seminar.css') }}">
@endsection



@section('content')
    <div class="seminar">


        <section class="eventbox">
            <div class="leftbox">
                <div class="content">
                    <h1>Seminars Agenda</h1>
                    <p>
                        We encourage users to read by holding online and offline seminars in which we talk about a specific
                        book or any topic related to reading.
                    </p>

                    @if (auth('admin')->check())
                        <button class="creative">
                            <span class="shadoww"></span>
                            <span class="edgee"></span>
                            <a href="{{ route('seminar.create') }}"><span class="frontt text"> add seminar </span></a>
                        </button>
                        <button class="creative" type="button" data-toggle="modal" data-target="#modelsection">
                            <span class="shadoww"></span>
                            <span class="edgee"></span>
                            <span class="frontt text"> add speaker </span>
                        </button>
                        <div class="modal fade" id="modelsection" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('speaker.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Add speaker</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">


                                            <div class="form-row">
                                                <div class="form-group col-lg-6">
                                                    <label for="recipient-name" class="col-form-label">name</label>

                                                    <input type="text"
                                                        class="@error('name') is-invalid @enderror form-control"
                                                        name="name">

                                                    @error('name')
                                                        <span class="invalid-feedbackk">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror


                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label for="recipient-name" class="col-form-label">img</label>

                                                    <input type="file" class="@error('img') is-invalid @enderror "
                                                        name="img">

                                                    @error('img')
                                                        <span class="invalid-feedbackk">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror


                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">phone</label>

                                                <input type="text"
                                                    class="@error('phone') is-invalid @enderror form-control"
                                                    name="phone">

                                                @error('phone')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror


                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">about</label>

                                                <input type="text"
                                                    class="@error('about') is-invalid @enderror form-control"
                                                    name="about">

                                                @error('about')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror


                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">email</label>

                                                <input type="text"
                                                    class="@error('email') is-invalid @enderror form-control"
                                                    name="email">

                                                @error('email')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror


                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">linked_in</label>

                                                <input type="text"
                                                    class="@error('linked_in') is-invalid @enderror form-control"
                                                    name="linked_in">

                                                @error('linked_in')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror


                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="creative close" data-dismiss="modal">
                                                <span class="shadoww"></span>
                                                <span class="edgee"></span>
                                                <span class="frontt text"> close </span>
                                            </button>
                                            <button type="submit" class="creative">
                                                <span class="shadoww"></span>
                                                <span class="edgee"></span>
                                                <span class="frontt text"> submit </span>
                                            </button>

                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>
                    @endif

                </div>
            </div>
            <div class="events">
                <ul>
                    @forelse ($seminar as $meet)
                        <li>
                            <div class="seminar_name">
                                <h2> {{ $meet->seminar_name }}</h2>
                                <p>{{ $meet->topic }}</p>
                                @if ($meet->type == 'online')
                                    <p>online</p>
                                    <a href="{{ $meet->join_url }}" target="_blank">seminar link</a>
                                @else
                                    <p>offline</p>
                                    <p>{{ $meet->address }}</p>
                                @endif
                                @if (auth('admin')->check())
                                    @if ($meet->type == 'online')
                                        <a href="{{ route('seminar.destroy', $meet->meeting_id) }}"><i
                                                class="fa-solid fa-trash-can"></i></a>
                                    @else
                                        <a href="{{ route('seminar.destroyoff', $meet->id) }}"><i
                                                class="fa-solid fa-trash-can"></i></a>
                                    @endif
                                @endif

                            </div>
                            <div class="detiales">
                                <h3>{{ $meet->start_time }}</h3>
                                <p>{{ $meet->seminar_des }}</p>
                                @if ($meet->type == 'online')
                                    <a href="{{ route('seminar.show', $meet->id) }}">view detials</a>
                                @else
                                    <a href="{{ route('seminar.show', $meet->id) }}">view detials and book</a>
                                @endif
                            </div>
                            <div style="clear:both"></div>
                        </li>
                    @empty
                        <div class="alert alert-warning text-center">
                            no seminar now
                        </div>
                    @endforelse




                </ul>
            </div>
        </section>

        <div class="pricing-area">
            <div class="container-2">
                <div class="row">
                    <div class="  col-xl-4 col-sm-4">
                        <div class="single-price">
                            <div class="price-header">
                                <h3 class="title">online seminar</h3>
                            </div>
                            <div class="price-value">
                                <div class="value">
                                    <span class="currency">LE</span> <span class="amount">00.<span>00</span></span> <span
                                        class="month">/online seminar</span>
                                </div>
                            </div>
                            <ul class="deals">
                                <li>using zoom metting</li>

                            </ul>
                        </div>
                    </div>
                    <!-- <div class="col-md-4 col-sm-6">
                                    <div class="single-price">
                                        <div class="price-header">
                                            <h3 class="title">Corporate</h3>
                                        </div>
                                        <div class="price-value">
                                            <div class="value">
                                                <span class="currency">$</span> <span class="amount">39.<span>99</span></span> <span
                                                    class="month">/month</span>
                                            </div>
                                        </div>
                                        <ul class="deals">
                                            <li></li>
                                            <li>Lorem ipsum dolor.</li>
                                            <li>Lorem ipsum dolor.</li>
                                            <li>Lorem ipsum dolor.</li>
                                            <li>Lorem ipsum dolor.</li>
                                        </ul><a href="#">BOOK NOW</a>
                                    </div>
                                </div> -->
                    <div class="col-md-4 col-sm-4">
                        <div class="single-price">
                            <div class="price-header">
                                <h3 class="title">offline seminar</h3>
                            </div>
                            <div class="price-value">
                                <div class="value">
                                    <span class="currency">LE</span> <span class="amount">100.<span>00</span></span> <span
                                        class="month">/offline seminar</span>
                                </div>
                            </div>
                            <ul class="deals">
                                <li>offline </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="teambox">
            <div class="wrapper">
                <h1>Execultive Speakers</h1>
                @if ($errors->any() && auth('admin')->check())
                    <div class="container">
                        <div class="alert alert-danger alert-dismissible fade show col-lg-5" role="alert">
                            can't delete ,speaker exist in seminar
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
                <div class="our_team">
                    @forelse ($speaker as $man)
                        <div class="team_member">
                            <div class="member_img">
                                <img src="{{ asset('attachments') . '/' . 'speaker' . $man->id . '/' . $man->img }}"
                                    alt="our_team">
                                <div class="social_media">

                                    <a href="{{ $man->linked_in }}" class="instagram item"><i
                                            class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                            <h3>
                                {{ $man->name }}
                                @if (auth('admin')->check())
                                    <a href="{{ route('speaker.destroy', $man->id) }}"><i
                                            class="fa-solid fa-trash"></i></a>
                                @endif


                            </h3>
                            <p>
                                {{ $man->about }}
                            </p>

                        </div>

                    @empty
                    @endforelse


                </div>
            </div>
        </div>
    </div>

@endsection
