@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endsection
@section('title')
    about
@endsection



@section('content')
    <div class="about">
        <div class="head">
            <h2>
                our new feature

            </h2>
            <div class="wrapper">
                <svg>
                    <text x="50%" y="50%" dy=".35em" text-anchor="middle">
                        book sharing
                    </text>
                </svg>
            </div>
            <p>see the video to know how to <a href="{{ route('booksharingsection.index') }}">share your book</a> and get
                your favourite book with 100 LE only </p>
        </div>
        <div class="container1">
            <div class="box1">
                <video src="{{ asset('assets/img/bookworm.mp4') }}" type="video/mp4" muted class="clip">


                </video>
            </div>

            <button class="creative" id="enablePlayback">
                <span class="shadoww"></span>
                <span class="edgee"></span>
                <span class="frontt text">click here and hover on video</span>
            </button>
        </div>
        <div class="head">
            <h1>
                our services

            </h1>


        </div>
        <div class="service">
            <ul class="cards">
                <li class="cards_item">
                    <div class="card">
                        <div class="card_image">
                            <img src="{{ asset('assets/img/about/panel.png') }}"
                                alt="mixed vegetable salad in a mason jar." />
                            <span class="card_price"><span>%</span>10</span>
                        </div>
                        <div class="card_content">
                            <h2 class="card_title">upload books</h2>
                            <div class="card_text">
                                <p>
                                    With the author account, the author can upload his books in exchange for taking a 10
                                    percent commission, and see his revenue but first he must wait for the admin to accept
                                    his book </p>
                                <hr />
                                <p>with the bookstore account, the bookstore can upload its books in exchange for a 10%
                                    commission, and see its revenues, but it must first wait for the administration’s
                                    approval of its book, and the library’s name will not be displayed.
                                </p>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="cards_item">
                    <div class="card">
                        <div class="card_image">
                            <img src="{{ asset('assets/img/about/seminar.png') }}" alt="a Reuben sandwich on wax paper." />
                            <span class="card_price"><span>LE</span>100</span>
                        </div>
                        <div class="card_content">
                            <h2 class="card_title">seminar</h2>
                            <div class="card_text">
                                <p>
                                    We encourage users to read by holding online and offline seminars in which we talk about
                                    a specific book or any topic related to reading.
                                </p>

                                <hr />
                                <p>
                                    The online seminar is free of charge, and the offline seminar is only 100 pounds.
                                </p>

                            </div>
                        </div>
                    </div>
                </li>

                <li class="cards_item">
                    <div class="card">
                        <div class="card_image">

                            <img src="{{ asset('assets/img/about/summary.png') }}"
                                alt="A side view of a plate of figs and berries." />
                            <span class="card_price"><span>LE</span>50</span>
                        </div>
                        <div class="card_content">
                            <h2 class="card_title">download summaries</h2>
                            <div class="card_text">
                                <p>If the user subscribes to the premium, he can download a book summary, an audio summary,
                                    or a video summary, depending on what is available.
                                </p>

                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <section class="contact">
            <div class="head">
                <h2>Contact Us</h2>
                @if (Session::has('done'))
                <div class="alert text-center  alert-success col-lg-12">
                    <p class="text-success">{{ session::get('done') }}</p>
                </div>
            @endif

            </div>
            <div class="container">

                <div class="contactinfo">

                    <div class="box">
                        <div class="icon"><b><i class="fa-solid fa-phone"></i></b></div>
                        <div class="text">
                            <h3>Phone</h3>
                            <p>+201223226011</p>
                        </div>
                    </div>
                    <div class="box">
                        <div class="icon"><b><i class="fa-solid fa-envelope"></i></b></div>
                        <div class="text">
                            <h3>Email</h3>
                            <p>bookworm@gmail.com</p>
                        </div>
                    </div>


                </div>
                <div class="contactform">

                    <form method="POST" action="{{route('about.store')}}">
                        <h2>Send Message</h2>
                        @csrf
                        <div class="inputbox">
                            <input type="text" name="name" class="@error('name') is-invalid @enderror "
                                value="{{ Auth()->user()->name}}">
                            <span>Full Name</span>
                        </div>

                        @error('name')
                            <span class="invalid-feedbackk">
                                {{ $message }}
                            </span>
                        @enderror
                        <div class="inputbox">
                            <input type="email" name="email" class="@error('email') is-invalid @enderror "
                                value="{{ Auth()->user()->email}}">
                            <span>Email</span>
                        </div>
                        @error('email')
                            <span class="invalid-feedbackk">
                                {{ $message }}
                            </span>
                        @enderror
                        <div class="inputbox">
                            <textarea name="message" class="@error('message') is-invalid @enderror " value="{{ old('message') }}"></textarea>
                            <span>Type your message..</span>
                        </div>
                        @error('message')
                            <span class="invalid-feedbackk">
                                {{ $message }}
                            </span>
                        @enderror
                        @if (auth('web')->check()||auth('author')->check()||auth('bookstore')->check())
                        <div class="inputbox">
                            <input type="submit" value="Send">

                        </div>
                        @endif

                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let userHasInteracted = false;

            const enablePlaybackButton = document.getElementById('enablePlayback');
            const clip = document.querySelector('.clip');

            enablePlaybackButton.addEventListener('click', function() {
                userHasInteracted = true;
                console.log('User interaction detected, video playback enabled.');

                clip.addEventListener('mouseenter', function() {
                    if (userHasInteracted) {
                        clip.play().catch(function(error) {
                            console.log('Playback failed:', error);
                        });
                    }
                });

                clip.addEventListener('mouseout', function() {
                    clip.pause();
                });
            });
        });
    </script>
@endsection
