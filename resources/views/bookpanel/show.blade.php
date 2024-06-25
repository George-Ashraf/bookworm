@extends('layouts.master')
@section('title')
    books
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection
@section('content')
    <div class="product-detail">
        <div class="show-product">
            <div class="container-fluid">
                <div class="row">
                    <!-- card left -->
                    <div class="product-imgs col-lg-5">
                        <div class="img-border">

                            <img
                                src="{{ asset('attachments') . '/' . 'book_panel' . $all_book->id . '/' . $all_book->book_cover }}">
                        </div>

                    </div>
                    <!-- card right -->
                    <div class="product-content col-lg-5">
                        <a href="{{ route('bookpanel.all') }}"><i class="fa-regular fa-circle-left"></i></a>
                        <h2 class="product-title"> {{ $all_book->book_name }}</h2>
                        <div class="author-rating">
                            <p><span>author:</span>{{ $all_book->author }}</p>
                            <div class="product-rating">

                                @if ($all_book->rate == 'done')


                                    @if ($ave >= 4.5)
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    @elseif ($ave >= 3.5)
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    @elseif ($ave >= 2.5)
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    @elseif ($ave >= 1.5)
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    @elseif ($ave >= 0.5)
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    @else
                                        <p>No Rating</p>
                                    @endif
                                    <span> {{ number_format( $ave , 1)}}</span>
                                @endif
                            </div>
                        </div>

                        @if ($all_book->format == 'hard copy & soft copy')
                            <p class="price">{{ $all_book->pricehard }}-{{ $all_book->pricesoft }}</p>
                        @elseif ($all_book->format == 'soft copy')
                            <p class="price">{{ $all_book->pricesoft }}</p>
                        @else
                            <p class="price">{{ $all_book->pricehard }}</p>
                        @endif
                        <div class="product-des">
                            <div class="description">
                                <p>{{ $all_book->description }}</p>

                            </div>


                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                @if ($all_book->format == 'hard copy & soft copy')
                                    <li class="nav-item" role="presentation">
                                        <input value="hard copy" class="nav-link active" id="pills-home-tab"
                                            data-toggle="pill" data-target="#pills-home" type="button" role="tab"
                                            aria-controls="pills-home" aria-selected="true">

                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <input value="soft copy" class="nav-link" id="pills-profile-tab" data-toggle="pill"
                                            data-target="#pills-profile" type="button" role="tab"
                                            aria-controls="pills-profile" aria-selected="false">
                                    </li>
                                @elseif ($all_book->format == 'soft copy')
                                    <li class="nav-item" role="presentation">
                                        <input value="soft copy" class="nav-link" id="pills-profile-tab" data-toggle="pill"
                                            data-target="#pills-profile" type="button" role="tab"
                                            aria-controls="pills-profile" aria-selected="false">
                                    </li>
                                @else
                                    <li class="nav-item" role="presentation">
                                        <input value="hard copy" class="nav-link active" id="pills-home-tab"
                                            data-toggle="pill" data-target="#pills-home" type="button" role="tab"
                                            aria-controls="pills-home" aria-selected="true">

                                    </li>
                                @endif


                                {{-- <li class="nav-item" role="presentation">
                            <input class="nav-link" value="audio book" id="pills-contact-tab" data-toggle="pill"
                                data-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">
                        </li> --}}
                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                @if ($all_book->format == 'hard copy & soft copy')
                                    <p class="tab-pane  fade show active" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">{{ $all_book->pricehard }}</p>
                                    <p class="tab-pane  fade" id="pills-profile" role="tabpanel"
                                        aria-labelledby="pills-profile-tab">{{ $all_book->pricesoft }}</p>
                                @elseif ($all_book->format == 'soft copy')
                                    <p class="tab-pane  fade" id="pills-profile" role="tabpanel"
                                        aria-labelledby="pills-profile-tab">{{ $all_book->pricesoft }}</p>
                                @else
                                    <p class="tab-pane  fade show active" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">{{ $all_book->pricehard }}</p>
                                @endif
                                {{-- <p class="tab-pane  fade" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab">{{$all_book->price}}</p> --}}
                            </div>

                        </div>
                        <div class="purchase-info">

                            @if ($all_book->status == 'private')
                                @if (auth('admin')->check())
                                    <a href="{{ route('all.status', $all_book->id) }}">
                                        <button type="button" class="btn creative">

                                            <span class="shadoww"></span>
                                            <span class="edgee"></span>
                                            <span class="frontt text">approve book</span>

                                        </button>
                                    </a>
                                    <p class="text-primary mt-3">imported by {{ $all_book->authorr->name }}
                                        {{ $all_book->admin->name }}{{ $all_book->bookstore->name }}</p>
                                @elseif (auth('author')->check())
                                    <p class="text-danger">wait admin to approve your book</p>
                                @elseif (auth('bookstore')->check())
                                    <p class="text-danger">wait admin to approve your book</p>
                                @endif
                            @else
                                <div class="alert alert-success" role="alert">
                                    book approved
                                </div>
                                <p class="text-danger">your book will be withdraw if there is a problem with it</p>

                                @if ($all_book->status == 'public')
                                    @if (auth('admin')->check())
                                        <a href="{{ route('all.status', $all_book->id) }}">
                                            <button type="button" class="btn creative">

                                                <span class="shadoww"></span>
                                                <span class="edgee"></span>
                                                <span class="frontt text">pull book</span>

                                            </button>
                                        </a>

                                            @if ($all_book->author_id)
                                            <p class="text-primary mt-3">imported by author: {{ $all_book->authorr->name }}</p>
                                            @elseif ($all_book->bookstore_id)
                                            <p class="text-primary mt-3">imported by bookstore: {{ $all_book->bookstore->bookstore_name }}</p>
                                            @elseif ($all_book->admin_id)
                                            <p class="text-primary mt-3">imported by admin: {{ $all_book->admin->name }}</p>
                                            @endif
                                    @endif
                                @endif

                            @endif
                        </div>

                        <p class="cate"><span>Categories:</span> {{ $all_book->cate->category_name }}</p>
                        <p class="info"><span>language:</span>{{ $all_book->language }}</p>


                        <a href="{{ route('all_book.edit', $all_book->id) }}"><i
                                class="fa-solid fa-pen-to-square"></i>edit your book</a>
                    </div>
                </div>

            </div>
        </div>

        <ul class="nav nav-pills pillsbox mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tabb" data-toggle="pill" data-target="#pills-homee"
                    type="button" role="tab" aria-controls="pills-homee" aria-selected="true">Description</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tabb" data-toggle="pill" data-target="#pills-contactt"
                    type="button" role="tab" aria-controls="pills-contactt" aria-selected="false">Reviews</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-homee" role="tabpanel" aria-labelledby="pills-home-tabb">
                <section class="des col-lg-6">
                    <p>
                        {{ $all_book->description }}
                    </p>

                </section>
            </div>

            <div class="tab-pane fade" id="pills-contactt" role="tabpanel" aria-labelledby="pills-contact-tabb">


                <section id="testimonials">

                    <div class="testimonial-heading">
                        <h1>reviews</h1>

                    </div>

                    <div class="testimonial-box-container">

                        @forelse ($reviews as $review)
                            <div class="testimonial-box">
                                <!--top------------------------->
                                <div class="box-top">
                                    <!--profile----->
                                    <div class="profile">
                                        <!--img---->

                                        <!--name-and-username-->
                                        <div class="name-user">
                                            <strong>
                                                {{ $review->name }}


                                                @if (auth('admin')->check())
                                                    <a href="{{ route('review.destroy', $review->id) }}"><i
                                                            class="fa-solid fa-trash"></i></a>
                                                @endif
                                            </strong>
                                        </div>
                                    </div>
                                    <!--reviews------>
                                    <div class="reviews">
                                        @if ($review->rate == 5)
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        @elseif ($review->rate == 4)
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        @elseif ($review->rate == 3)
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        @elseif ($review->rate == 2)
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        @elseif ($review->rate == 1)
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        @elseif ($review->rate == 0)
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        @endif

                                        <!--Empty star-->
                                    </div>
                                </div>
                                <!--Comments---------------------------------------->
                                <div class="client-comment">
                                    <p>{{ $review->review }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-danger">
                                no reviews
                            </div>
                        @endforelse


                    </div>
                </section>
                <!------------Add reviews-------->

                <!------------Add reviews-------->

            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
