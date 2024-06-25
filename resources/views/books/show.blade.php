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
                                src="{{ asset('attachments') . '/' . 'book_panel' . $product->id . '/' . $product->book_cover }}">
                        </div>

                    </div>
                    <!-- card right -->
                    <div class="product-content col-lg-5">
                        <h2 class="product-title">{{ $product->book_name }}</h2>

                        <div class="author-rating">
                            @if ($product->author_id)
                           <a href="{{route('author.show',$product->author_id)}}"><p><span>author:</span>{{ $product->author }}</p></a>

                            @else
                            <p><span>author:</span>{{ $product->author }}</p>

                            @endif
                            <div class="product-rating">

                                @if ($product->rate == 'done')
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
                                    <span>{{ number_format($ave, 1) }}</span>
                                @endif

                            </div>

                        </div>

                        @if ($product->format == 'hard copy & soft copy')
                            <p class="price">{{ $product->pricehard }}-{{ $product->pricesoft }}</p>
                        @elseif ($product->format == 'soft copy')
                            <p class="price">{{ $product->pricesoft }}</p>
                        @else
                            <p class="price">{{ $product->pricehard }}</p>
                        @endif
                        <div class="product-des">
                            <div class="description">
                                <p>{{ $product->description }}</p>


                            </div>

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                @if ($product->format == 'hard copy & soft copy')
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
                                @elseif ($product->format == 'soft copy')
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



                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                @if ($product->format == 'hard copy & soft copy')
                                    <p class="tab-pane  fade show active" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">
                                        {{ $product->pricehard }}
                                        @if ($product->choose == 'soft')
                                            <a class="choose" href="{{ route('chosse.format', $product->id) }}"
                                                type="button">chosse hard copy</a>
                                        @endif
                                    </p>
                                    <p class="tab-pane  fade" id="pills-profile" role="tabpanel"
                                        aria-labelledby="pills-profile-tab">
                                        {{ $product->pricesoft }}
                                        @if ($product->choose == 'hard')
                                            <a class="choose" href="{{ route('chosse.format', $product->id) }}"
                                                type="button">chosse soft copy</a>
                                        @endif
                                    </p>
                                @elseif ($product->format == 'soft copy')
                                    <p class="tab-pane fade" id="pills-profile" role="tabpanel"
                                        aria-labelledby="pills-profile-tab">
                                        {{ $product->pricesoft }}

                                    </p>
                                @else
                                    <p class="tab-pane  fade show active" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">{{ $product->pricehard }}</p>
                                @endif

                            </div>

                        </div>
                        @if (auth('web')->check())
                            <div class="purchase-info">
                                <a href="{{ route('paymentbook.create', $product->id) }}">
                                    <button type="button" class="btn">

                                        <i class="fa-solid fa-cart-shopping"></i> buy

                                    </button>
                                </a>

                                @if (Session::has('done'))
                                    <div class="alert text-center alert-success col-lg-12 mt-2">
                                        <p>{{ session::get('done') }}</p>
                                    </div>
                                @endif


                            </div>
                        @endif


                        <p class="cate"><span>Categories:</span><a
                                href="{{ route('category.show', $product->category_id) }}">{{ $product->cate->category_name }}</a>
                        </p>
                        <p class="info"><span>language:</span>{{ $product->language }}</p>
                        @if ($product->summary == 'none')
                            @if (auth('admin')->check())
                                <button class="Download-button">

                                    <i class="fa-solid fa-plus"></i>
                                    <a href="{{ route('summary.create', $product->id) }}">add summary</a>
                                </button>
                            @endif
                        @else
                            @if ((Auth::user()->premium == 'done' && auth('web')->check()) || auth('admin')->check())
                                <p class="summary-text">
                                    click to this buttons to download your favourite summary
                                    @if (auth('admin')->check())
                                        <a href="{{ route('summary.destroy', $summary->id) }}"><i
                                                class="fa-regular fa-trash-can"></i></a>
                                        <a href="{{ route('summary.edit', $summary->id) }}"><i
                                                class="fa-solid fa-pen-nib"></i></a>
                                    @endif
                                </p>
                                @if ($summary->novel_film_link)
                                    <a class="summary-text" href="{{ $summary->novel_film_link }}">novel film link</a>
                                @endif
                                @if ($summary->written_summary && $summary->video_summary && $summary->voice_summary)
                                    <button class="Download-button">

                                        <i class="fa-solid  fa-feather"></i>
                                        <a
                                            href="{{ route('download.written', [$summary->written_summary, $summary->id]) }}">written
                                            summary</a>
                                    </button>
                                    <button class="Download-button">

                                        <i class="fa-solid fa-video"></i>
                                        <a href="{{ route('download.video', [$summary->video_summary, $summary->id]) }}">video
                                            summary</a>
                                    </button>
                                    <button class="Download-button">

                                        <i class="fa-solid fa-volume-high"></i>
                                        <a href="{{ route('download.audio', [$summary->voice_summary, $summary->id]) }}">voice
                                            summary</a>
                                    </button>
                                @elseif ($summary->written_summary && $summary->video_summary)
                                    <button class="Download-button">

                                        <i class="fa-solid  fa-feather"></i>
                                        <a
                                            href="{{ route('download.written', [$summary->written_summary, $summary->id]) }}">written
                                            summary</a>
                                    </button>
                                    <button class="Download-button">

                                        <i class="fa-solid fa-video"></i>
                                        <a href="{{ route('download.video', [$summary->video_summary, $summary->id]) }}">video
                                            summary</a>
                                    </button>
                                @elseif ($summary->written_summary && $summary->voice_summary)
                                    <button class="Download-button">

                                        <i class="fa-solid  fa-feather"></i>
                                        <a
                                            href="{{ route('download.written', [$summary->written_summary, $summary->id]) }}">written
                                            summary</a>
                                    </button>
                                    <button class="Download-button">

                                        <i class="fa-solid fa-volume-high"></i>
                                        <a href="{{ route('download.audio', [$summary->voice_summary, $summary->id]) }}">voice
                                            summary</a>
                                    </button>
                                @elseif ($summary->video_summary && $summary->voice_summary)
                                    <button class="Download-button">

                                        <i class="fa-solid fa-video"></i>
                                        <a href="{{ route('download.video', [$summary->video_summary, $summary->id]) }}">video
                                            summary</a>
                                    </button>
                                    <button class="Download-button">

                                        <i class="fa-solid fa-volume-high"></i>
                                        <a href="{{ route('download.audio', [$summary->voice_summary, $summary->id]) }}">voice
                                            summary</a>
                                    </button>
                                @elseif ($summary->written_summary)
                                    <button class="Download-button">

                                        <i class="fa-solid  fa-feather"></i>
                                        <a
                                            href="{{ route('download.written', [$summary->written_summary, $summary->id]) }}">written
                                            summary</a>
                                    </button>
                                @elseif ($summary->video_summary)
                                    <button class="Download-button">

                                        <i class="fa-solid fa-video"></i>
                                        <a href="{{ route('download.video', [$summary->video_summary, $summary->id]) }}">video
                                            summary</a>
                                    </button>
                                @elseif ($summary->voice_summary)
                                    <button class="Download-button">

                                        <i class="fa-solid fa-volume-high"></i>
                                        <a href="{{ route('download.audio', [$summary->voice_summary, $summary->id]) }}">voice
                                            summary</a>
                                    </button>
                                @endif
                            @elseif (Auth::user()->premium == 'none' && auth('web')->check())
                                <div class="alert alert-warning">
                                    subscribe to premium to see book summaries
                                </div>
                            @endif
                        @endif




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
                        {{ $product->description }}
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

                                                @if ($review->reader_id == Auth::user()->id && auth('web')->check())
                                                    <a href="{{ route('review.destroy', $review->id) }}"><i
                                                            class="fa-solid fa-trash"></i></a>
                                                @elseif (auth('admin')->check())
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
                @if (auth('web')->check())
                    <div class="add">
                        <h1>add your review</h1>
                    </div>

                    <div class="container">
                        <form action="{{ route('review.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $product->id }}">

                            <div class="star-widget">
                                <div class="rating">
                                    <input value="5" name="rating" id="star5" type="radio">


                                    <label for="star5"></label>
                                    <input value="4" name="rating" id="star4" type="radio">


                                    <label for="star4"></label>
                                    <input value="3" name="rating" id="star3" type="radio">


                                    <label for="star3"></label>
                                    <input value="2" name="rating" id="star2" type="radio">


                                    <label for="star2"></label>
                                    <input value="1" name="rating" id="star1" type="radio"
                                        class="@error('description') is-invalid @enderror">


                                    <label for="star1"></label>

                                </div>

                                <div class="textarea">
                                    <textarea cols="60" placeholder="Describe your review.." name="review"
                                        class="form-control @error('review') is-invalid @enderror"></textarea>
                                    @error('review')
                                        <span class="invalid-feedbackk">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                @error('review')
                                    <span class="invalid-feedbackk">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <div class="btn">
                                    <button type="submit">submit</button>
                                </div>
                        </form>

                    </div>
                @endif

            </div>
        </div>
    </div>
    </div>
@endsection
@section('js')
@endsection
