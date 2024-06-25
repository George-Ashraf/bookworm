@extends('layouts.master')
@section('title')
    more detail
@endsection

<div class="showbooksharing">
    <h1><i class="fa-solid fa-book-open"></i> show book</h1>

    <div class="container-fluid">
        <div class="row">
            <div class="img col-lg-3">
                @if ($booksharing_one->format == 'soft copy')
                    @if ($booksharingsection->payment_two == 'done')

                        <object data="{{ asset('attachments') .'/' .'booksharing_one'.$booksharing_one->id . '/' . $booksharing_one->book_file }}"
                            type="application/pdf" width="300" height="500"></object>
                        <a href="{{ route('downloadshare.download', [$booksharing_one->book_file,$booksharing_one->id]) }}">
                            <button class="download">
                                <p class="text">
                                    Download
                                </p>
                                <div class="svg">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="white"
                                        class="bi bi-download"viewBox="0 0 16 16">
                                        <path
                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z">
                                        </path>
                                        <path
                                            d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z">
                                        </path>
                                    </svg>
                                </div>
                            </button>
                        </a>
                    @else
                        @if ($booksharing_one->reader_id == Auth::user()->id)
                            <object data="{{ asset('attachments').'/' .'booksharing_one'.$booksharing_one->id . '/' . $booksharing_one->book_file }}"
                                type="application/pdf" width="300" height="500"></object>
                        @else
                            <div class="alert alert-warning" role="alert">
                                Once you pay for sharing, your book will appear here and you can download it

                            </div>
                        @endif

                    @endif
                @else
                    <div class="alert alert-warning" role="alert">
                        no soft copy displayed <strong>this is hard copy</strong>

                    </div>
                @endif


            </div>
            <div class="info col-lg-6">
                <div class="p">
                    <p> <span>book name:</span> {{ $booksharing_one->book_name }}</p>
                    <p> <span>Type of the book :</span> {{ $booksharing_one->type_of_book }}</p>
                    <p> <span>author:</span> {{ $booksharing_one->author }}</p>
                    <p><span>Format :</span>{{ $booksharing_one->format }}</p>
                    <p> <span> Language:</span>{{ $booksharing_one->language }}</p>
                    <p><span>Used around:</span>{{ $booksharing_one->used_around }}</p>
                    <p> <span>book Description:</span> {{ $booksharing_one->description }} </p>
                    <p><span>my requested book: </span> {{ $booksharing_one->book_you_want_description }} </p>
                </div>


                @if ($booksharingsection->booksharing_two_upload == 'submit')


                    @if ($booksharing_one->reader_id == Auth::user()->id)
                        @if ($booksharingsection->status_one == 'accept')
                            <div class="alert alert-success" role="alert">
                                book accepted
                            </div>
                            @if ($booksharingsection->payment_one == 'none')
                                <a href="{{ route('createpaymentshare_one.create', $booksharing_one->id) }}">
                                    <button class="pay">
                                        Pay
                                        <svg class="svgIcon" viewBox="0 0 576 512">
                                            <path
                                                d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z">
                                            </path>
                                        </svg>
                                    </button>
                                </a>
                            @else
                                <div class="alert alert-success text-center" role="alert">
                                    Payment has been made and you will receive the book within 24 hours if it
                                    hardcopy and if the book softcopy <a
                                        href="{{ route('book.show2', [$booksharing_two->id, $booksharingsection->id]) }}"
                                        class="link"> go to </a> {{ $booksharing_two->name }} book to download


                                </div>
                            @endif
                        @else
                            <h3>{{ $booksharing_two->name }} upload book <a class="link"
                                    href="{{ route('book.show2', [$booksharing_two->id, $booksharingsection->id]) }}">see
                                    it</a> and accept or <strong>reject</strong> and wait {{ $booksharing_two->name }}
                                to accept your
                                book</h3>


                        @endif
                    @else
                        @if ($booksharingsection->status_two == 'accept')
                            <a href="{{ route('change.status', $booksharingsection->id) }}">

                                @if ($booksharingsection->status_one == 'reject')
                                    <button class="creative">
                                        <span class="shadoww"></span>
                                        <span class="edgee"></span>
                                        <span class="frontt text"> accept request</span>
                                    </button>
                                @else
                                    <div class="alert alert-success" role="alert">
                                        book accepted
                                    </div>
                                    @if ($booksharingsection->payment_two == 'done')
                                    <a href="{{route('book.show2',[$booksharing_two->id,$booksharingsection->id])}}" class="link">go to your book <i class="fa-solid fa-arrow-up-right-from-square"></i></a>

                                    @else
                                    <a href="{{route('book.show2',[$booksharing_two->id,$booksharingsection->id])}}" class="link">go to pay <i class="fa-solid fa-arrow-up-right-from-square"></i></a>

                                    @endif
                                @endif
                            </a>
                        @else
                            <h3>wait {{ $booksharing_one->name }} to accept your book</h3>

                        @endif
                    @endif
                @else
                    @if ($booksharing_one->reader_id == Auth::user()->id)
                        <h3><i class="fa-regular fa-face-smile-beam"></i> wait another user
                            upload his or her book<i class="fa-regular fa-face-smile-beam"></i></h3>
                    @else
                        <h3><i class="fa-solid fa-circle-exclamation"></i>Place your book first in the other section
                            and
                            wait for {{$booksharing_one->name}} to accept your book. <br> <br><i class="fa-regular fa-face-smile-beam"></i>
                            When he accepts your book, accept button will appear <i
                                class="fa-regular fa-face-smile-beam"></i></h3>
                    @endif


                @endif

            </div>
            <div class="profile col-lg-3">
                <img src="{{ asset('attachments') .'/' .'booksharing_one'.$booksharing_one->id . '/' . $booksharing_one->image }}" alt="">
                <h1>{{ $booksharing_one->name }}</h1>

                @if ($booksharing_one->reader_id == Auth::user()->id)
                    @if ($booksharingsection->status_two == 'reject')
                        <a href="{{ route('book.edit', [$booksharing_one->id, $booksharing_one->BS_section_id]) }}"><i
                                class="fa-solid fa-file-pen"></i>
                            edit your book info</a>
                        <a href="{{ route('book.destroy', [$booksharing_one->id, $booksharingsection->id]) }}"><i
                                class="fa-solid fa-trash"></i>
                            delete
                            your sharing</a>
                    @endif

                @endif
                @if (auth('admin')->check())
                    <a href="{{ route('book.edit', [$booksharing_one->id, $booksharing_one->BS_section_id]) }}"><i
                            class="fa-solid fa-file-pen"></i> edit your book info</a>
                @endif


            </div>
        </div>
    </div>
</div>

@section('js')
@endsection
