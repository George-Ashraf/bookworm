@extends('layouts.master')
@section('css')
@endsection
@section('title')
    bookworm
@endsection



@section('content')
    <div class="home">
        <div class="welcomebox desktop">
            <div class="container-fluid">
                <div class="row">
                    <div class="img  col-lg-6">
                        <img src="{{ asset('assets/img/home.svg') }}"
                            class="animate__animated animate__zoomIn"data-wow-duration="3s" alt="">
                    </div>
                    <div class="welcome col-lg-6">
                        <h1>
                            <div class="animate__animated animate__fadeInUp" data-wow-duration="1s" data-wow-delay="1.5s">
                                meet your next
                            </div>

                            <div class="animate__animated animate__fadeInUp" data-wow-duration="2s" data-wow-delay="1.5s">
                                favourite book and
                            </div>
                            <span class=" animate__animated animate__fadeInUp" data-wow-duration="3s"
                                data-wow-delay="1.5s">share it ! <img src="{{ asset('assets/img/llline.svg') }}"
                                    alt=""></span>
                        </h1>


                        @if (auth('admin')->check())
                            <a href="{{ route('admin.create') }}" class="animate__animated animate__swing"
                                data-wow-delay="3.5s">
                                <button class="animated-button">
                                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                        </path>
                                    </svg>
                                    <span class="text">add admins</span>
                                    <span class="circle"></span>
                                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                        </path>
                                    </svg>
                                </button>
                            </a>
                        @elseif (auth('web')->check())
                            <a href="{{ route('booksharingsection.index') }}" class="animate__animated animate__swing"
                                data-wow-delay="3.5s">
                                <button class="animated-button">
                                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                        </path>
                                    </svg>
                                    <span class="text">share book now!</span>
                                    <span class="circle"></span>
                                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                        </path>
                                    </svg>
                                </button>
                            </a>
                        @elseif (auth('author')->check())
                            <a href="{{ route('bookpanel.all') }}" class="animate__animated animate__swing"
                                data-wow-delay="3.5s">
                                <button class="animated-button">
                                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                        </path>
                                    </svg>
                                    <span class="text">add your book!</span>
                                    <span class="circle"></span>
                                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                        </path>
                                    </svg>
                                </button>
                            </a>
                        @elseif (auth('bookstore')->check())
                            <a href="{{ route('bookpanel.all') }}" class="animate__animated animate__swing"
                                data-wow-delay="3.5s">
                                <button class="animated-button">
                                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                        </path>
                                    </svg>
                                    <span class="text">add your book!</span>
                                    <span class="circle"></span>
                                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                        </path>
                                    </svg>
                                </button>
                            </a>
                        @else
                            <a href="{{ route('booksharingsection.index') }}" class="animate__animated animate__swing"
                                data-wow-delay="3.5s">
                                <button class="animated-button">
                                    <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                        </path>
                                    </svg>
                                    <span class="text">share book now!</span>
                                    <span class="circle"></span>
                                    <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                        </path>
                                    </svg>
                                </button>
                            </a>
                        @endif

                    </div>
                </div>
            </div>

        </div>
        <div class="welcomebox reseponsive">
            <div class="container-fluid">
                <div class="row">

                    <div class="welcome col-lg-6">
                        <h1>meet your next favourite book and
                            <span>share it ! <img src="{{ asset('assets/img/llline.svg') }}" alt=""></span>


                        </h1>

                        @if (auth('admin')->check())
                        <a href="{{ route('admin.create') }}" class="animate__animated animate__swing"
                            data-wow-delay="3.5s">
                            <button class="animated-button">
                                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                    </path>
                                </svg>
                                <span class="text">add admins</span>
                                <span class="circle"></span>
                                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                    </path>
                                </svg>
                            </button>
                        </a>
                    @elseif (auth('web')->check())
                        <a href="{{ route('booksharingsection.index') }}" class="animate__animated animate__swing"
                            data-wow-delay="3.5s">
                            <button class="animated-button">
                                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                    </path>
                                </svg>
                                <span class="text">share book now!</span>
                                <span class="circle"></span>
                                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                    </path>
                                </svg>
                            </button>
                        </a>
                    @elseif (auth('author')->check())
                        <a href="{{ route('bookpanel.all') }}" class="animate__animated animate__swing"
                            data-wow-delay="3.5s">
                            <button class="animated-button">
                                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                    </path>
                                </svg>
                                <span class="text">add your book!</span>
                                <span class="circle"></span>
                                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                    </path>
                                </svg>
                            </button>
                        </a>
                    @elseif (auth('bookstore')->check())
                        <a href="{{ route('bookpanel.all') }}" class="animate__animated animate__swing"
                            data-wow-delay="3.5s">
                            <button class="animated-button">
                                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                    </path>
                                </svg>
                                <span class="text">add your book!</span>
                                <span class="circle"></span>
                                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                    </path>
                                </svg>
                            </button>
                        </a>
                    @else
                        <a href="{{ route('booksharingsection.index') }}" class="animate__animated animate__swing"
                            data-wow-delay="3.5s">
                            <button class="animated-button">
                                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                    </path>
                                </svg>
                                <span class="text">share book now!</span>
                                <span class="circle"></span>
                                <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                    </path>
                                </svg>
                            </button>
                        </a>
                    @endif
                    </div>
                    <div class="img col-lg-6">
                        <img src="{{ asset('assets/img/home.svg') }}" alt="">
                    </div>
                </div>
            </div>

        </div>




        <div class="bookbox">
            <div class="head container-fluid">
                <div class="row">
                    <h1>Our Favourite Reads</h1>
                    <a href="{{ route('product.index') }}">
                        <button class="animated-button">
                            <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                </path>
                            </svg>
                            <span class="text">view all</span>
                            <span class="circle"></span>
                            <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                                </path>
                            </svg>
                        </button>
                    </a>
                </div>

            </div>
            <div class="swiper mySwiper">

                <div class="swiper-wrapper">
                    @forelse ($product as $pro)
                        <div class="swiper-slide col-lg-3 col-md-3">
                            <div class="product-grid">
                                <div class="product-image">
                                    <a href="{{ route('product.show', $pro->id) }}" class="image">
                                        <img class="pic-1"
                                            src="{{asset('attachments').'/' .'book_panel'.$pro->id .'/' . $pro->book_cover  }}">
                                        <img class="pic-2"
                                            src="{{asset('attachments').'/' .'book_panel'.$pro->id .'/' . $pro->book_cover  }}">
                                    </a>

                                    <ul class="product-links">

                                        <li><a href="{{ route('product.show', $pro->id) }}" data-tip="View"><i
                                                    class="fa-regular fa-eye"></i></a></li>
                                        <li><a href="{{ route('product.show', $pro->id) }}" data-tip="Add to Cart"><i
                                                    class="fa-solid fa-cart-shopping"></i></a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a
                                            href="{{ route('product.show', $pro->id) }}">{{ $pro->book_name }}</a></h3>

                                    <p class="author">{{ $pro->author }}</p>
                                    @if ($pro->format == 'hard copy & soft copy')
                                        <h2 class='price'>{{ $pro->pricesoft }} LE</h2 class='price'>
                                    @elseif ($pro->format == 'soft copy')
                                        <h2 class='price'>{{ $pro->pricesoft }} LE</h2 class='price'>
                                    @else
                                        <h2 class='price'>{{ $pro->pricehard }} LE</h2 class='price'>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-danger">
                            no books
                        </div>
                    @endforelse


                </div>
            </div>
        </div>
        @if (auth('web')->check())
            <div class="premium">
                <div class="container-fluid">
                    <div class="row">
                        <div class="card">
                            <div class="header">
                                <span class="title">Normal</span>
                                <span class="price">Free</span>
                            </div>
                            <p class="desc">this is a default user</p>
                            <ul class="lists">
                                <li class="list">

                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>booksharing</span>
                                </li>
                                <li class="list">

                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>seminar</span>
                                </li>
                                <li class="list">

                                    <i class="fa-solid fa-circle-xmark text-danger"></i>
                                    <span>download all type of book summary</span>
                                </li>
                            </ul>

                        </div>
                        <div class="card">
                            <div class="header">
                                <span class="title">premium</span>
                                <span class="price">50 LE</span>
                            </div>
                            <p class="desc">this is a premium user</p>
                            <ul class="lists">
                                <li class="list">

                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>booksharing</span>
                                </li>
                                <li class="list">

                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>seminar</span>
                                </li>
                                <li class="list">

                                    <i class="fa-solid fa-circle-check"></i>

                                    <span>download all type of book summary</span>
                                </li>
                            </ul>
                            @if (Auth::user()->premium == 'done')
                            <button  class="action done">Subscribed</button>

                            @else
                            <a href="{{ route('premium.create') }}">
                                <button type="button" class="action">Subscribe</button>

                            </a>
                            @endif

                        </div>
                    </div>
                </div>

            </div>
        @endif

        <div class="opinionbox">
            <div class="modal fade" id="modelsection2" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <form method='POST' action="{{ route('opinion.store') }}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add opinion</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">



                                <div class="form-group">
                                    <label for="validationDefault05">job </label>
                                    <input type="text" class="@error('job') is-invalid @enderror form-control"
                                        value="{{ old('job') }}" name="job">
                                    @error('job')
                                        <span class="invalid-feedbackk">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="validationDefault05">opinion</label>
                                    <input type="text" class="@error('opinion') is-invalid @enderror form-control"
                                        value="{{ old('opinion') }}" name="opinion">
                                    @error('opinion')
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
            <div class="opinion col-lg-4">
                @auth
                    <button class="creative" data-toggle="modal" data-target="#modelsection2">
                        <span class="shadoww"></span>
                        <span class="edgee"></span>
                        <span class="frontt text"> add opinion </span>
                    </button>
                @endauth

                <div class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        @forelse ($opinion as $say)
                            <div class="swiper-slide say">

                                <h2>
                                    what people saying!
                                    @auth
                                        @if ($say->name == Auth::user()->name)
                                            <a href="{{ route('opinion.destroy', $say->id) }}">
                                                <i class="fa-solid fa-trash"></i>

                                            </a>
                                        @elseif (auth('admin')->check())
                                            <a href="{{ route('opinion.destroy', $say->id) }}">
                                                <i class="fa-solid fa-trash"></i>

                                            </a>
                                        @endif
                                    @endauth
                                </h2>
                                <h3>{{ $say->opinion }}</h3>

                                <p>{{ $say->name }}/ <span>{{ $say->job }}</span><i
                                        class="fa-solid fa-quote-left"></i></p>

                            </div>
                        @empty
                            <div class="alert alert-primary" role="alert">
                                no opinion now add your opinion
                            </div>
                        @endforelse

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <div class="img">
                <img src="{{ asset('assets/img/opinion.svg') }}" alt="">

            </div>



        </div>

        <div class="quotesbox">
            <div class="head">
                @auth
                    <button class="creative" data-toggle="modal" data-target="#modelsection">
                        <span class="shadoww"></span>
                        <span class="edgee"></span>
                        <span class="frontt text"> add quotes </span>
                    </button>
                @endauth

                <h1>quotes</h1>
            </div>

            <div class="modal fade" id="modelsection" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <form method='POST' action="{{ route('quotes.store') }}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add quotes</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">


                                <div class="form-group">
                                    <label for="validationDefault05">author</label>
                                    <input type="text" class="@error('author') is-invalid @enderror form-control"
                                        value="{{ old('author') }}" name="author">
                                    @error('author')
                                        <span class="invalid-feedbackk">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="validationDefault05">reference </label>
                                    <p class="text-danger">* not required</p>
                                    <input type="text" class="@error('reference') is-invalid @enderror form-control"
                                        value="{{ old('reference') }}" name="reference">
                                    @error('reference')
                                        <span class="invalid-feedbackk">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="validationDefault05">quotes</label>
                                    <input type="text" class="@error('quotes') is-invalid @enderror form-control"
                                        value="{{ old('quotes') }}" name="quotes">
                                    @error('quotes')
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

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @forelse ($quotes as $quote)
                        <div class="swiper-slide quotes">

                            <div class="quote">
                                <h2 class="name">

                                    {{ $quote->name }}
                                    @auth
                                        @if ($quote->name == Auth::user()->name)
                                            <a href="{{ route('quote.destroy', $quote->id) }}">
                                                <i class="fa-solid fa-trash"></i>

                                            </a>
                                        @elseif (auth('admin')->check())
                                            <a href="{{ route('quote.destroy', $quote->id) }}">
                                                <i class="fa-solid fa-trash"></i>

                                            </a>
                                        @endif
                                    @endauth

                                </h2>
                                <p class="text"><i class="fa-solid fa-quote-left"></i>{{ $quote->quotes }}<i
                                        class="fa-solid fa-quote-right"></i></p>
                                <div class="info">
                                    <p class="refe">{{ $quote->reference }}</p>
                                    <p class="author">{{ $quote->author }}</p>
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="alert alert-primary" role="alert">
                            no quotes now add your quotes
                        </div>
                    @endforelse


                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </div>
@endsection
@section('js')
@endsection
