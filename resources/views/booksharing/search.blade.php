@extends('layouts.master')
@section('title')
    booksharing
@endsection
@section('css')
@endsection



@section('content')

    <div class="booksharing">

        <div class="searchBox">
            <form action="{{route('booksharing.search')}}" >
                <input class="searchInput" type="text" name="search" placeholder="Search something" value="{{isset($search)? $search : ''}}">
                <button class="searchButton">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>

            </form>


    </div>
    </div>
    @if(isset($name))
    @if($se_booksharingsection->isEmpty())
    <div class="booksharing">
        <div class="alert alert-danger">
            <h4>No books found for "{{ $name }}".</h4>

        </div>
    </div>

    @else
    @forelse ($se_booksharingsection as $section)
    @if (
        $section->share_one == Auth::user()->id ||
            $section->share_two == Auth::user()->id ||
            ($section->payment_one == 'none' && $section->payment_two == 'none'))
        <div class="booksharing" >

            <h1>
                @if (auth('admin')->check())
                    <a href="{{ route('booksharingsection.destroy', $section->id) }}"><i
                            class="fa-solid fa-trash"></i></a>
                @endif {{ $section->section_name }}'s sharing <i
                    class="fa-solid fa-arrow-up-right-from-square"></i>
            </h1>
            @if (Session::has('done'))
                <div class="alert text-center alert-success col-lg-5">
                    <p>{{ session::get('done') }}</p>
                </div>
            @endif
            <div class="container-fluid">
                <section class="book-showcase row">

                    @forelse ($section->booksharingone as $book)

                        <div class="share">
                            <div class="profile" id="myTable">
                                <img src="{{ asset('attachments') . '/' . 'booksharing_one' . $book->id . '/' . $book->image }}"
                                    alt="">
                                <p class="tr">{{ $book->name }}</p>

                                <i class="fa-brands fa-staylinked"></i>
                            </div>
                            <div class="wrapper">
                                <div class="book">
                                    <div class="front"
                                        style="--img:url('{{ asset('attachments') . '/' . 'booksharing_one' . $book->id . '/' . $book->book_cover }}')">
                                        <h1>{{ $book->book_name }}</h1>
                                        <p>{{ $book->author }}</p>
                                    </div>
                                    <div class="side">
                                        <p>2024</p>
                                    </div>
                                    <div class="back">
                                        <h1>my request</h1>
                                        <p>{{ $book->book_you_want_description }}</p>
                                    </div>
                                    <div class="pages"></div>
                                    <div class="shadow"></div>
                                </div>
                                <button class="creative">
                                    <span class="shadoww"></span>
                                    <span class="edgee"></span>
                                    <a href="{{ route('book.show', [$book->id, $section->id]) }}"><span
                                            class="frontt text">
                                            more detail
                                        </span></a>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="share">

                            <div class="wrapper">
                                <div class="nobook">
                                    @if ($section->booksharing_two_upload == 'none')
                                        @if (!auth('admin')->check())
                                            <button class="sharebookbtn creative">
                                                <span class="shadoww"></span>
                                                <span class="edgee"></span>

                                                <a href="{{ route('book.create', $section->id) }}"><span
                                                        class="frontt text">
                                                        share book
                                                    </span></a>
                                            </button>
                                        @endif
                                    @else
                                        @if (Auth::user()->id == $section->share_two)
                                            <div class="alert alert-danger" role="alert">
                                                sorry, another user delete book by mistake


                                            </div>
                                        @else
                                            <div class="alert alert-danger" role="alert">
                                                By deleting the book, the book sharing destroyed.make a new bookshring
                                                section or wait another user to delete his sharing

                                            </div>
                                        @endif
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforelse

                    <div class="link">
                        <i class="fa-solid fa-link"></i>
                    </div>
                    @forelse ($section->booksharingtwo as $book2)
                        <div class="share">
                            <div class="profile">
                                <img src="{{ asset('attachments') . '/' . 'booksharing_two' . $book2->id . '/' . $book2->image }}"
                                    alt="">
                                <p>{{ $book2->name }}</p>
                                <i class="fa-brands fa-staylinked"></i>
                            </div>
                            <div class="wrapper">
                                <div class="book">
                                    <div class="front"
                                        style="--img:url('{{ asset('attachments') . '/' . 'booksharing_two' . $book2->id . '/' . $book2->book_cover }} ')">
                                        <h1>{{ $book2->book_name }}</h1>
                                        <p>{{ $book2->author }}</p>
                                    </div>
                                    <div class="side">
                                        <p>2024</p>
                                    </div>
                                    <div class="back">

                                    </div>
                                    <div class="pages"></div>
                                    <div class="shadow"></div>
                                </div>

                                <button class="creative">
                                    <span class="shadoww"></span>
                                    <span class="edgee"></span>
                                    <a href="{{ route('book.show2', [$book2->id, $section->id]) }}"><span
                                            class="frontt text"> more detail
                                        </span></a>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="share">

                            <div class="wrapper">
                                <div class="nobook">

                                    @if (!auth('admin')->check())
                                        @if ($section->booksharing_one_upload == 'submit' && $section->share_one != Auth::user()->id)
                                            <button class="sharebookbtn creative">
                                                <span class="shadoww"></span>
                                                <span class="edgee"></span>
                                                <a href="{{ route('book.create2', $section->id) }}"><span
                                                        class="frontt text">
                                                        share book
                                                    </span></a>
                                            </button>
                                        @endif
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforelse

                </section>

            </div>
        </div>
    @elseif (auth('admin')->check())
        <div class="booksharing">

            <h1>
                @if (auth('admin')->check())
                    <a href="{{ route('booksharingsection.destroy', $section->id) }}"><i
                            class="fa-solid fa-trash"></i></a>
                @endif {{ $section->section_name }}'s sharing <i
                    class="fa-solid fa-arrow-up-right-from-square"></i>
            </h1>
            <div class="container-fluid">
                <section class="book-showcase row">
                    @forelse ($section->booksharingone as $book)
                        <div class="share">
                            <div class="profile">
                                <img src="{{ asset('attachments') . '/' . 'booksharing_one' . $book->id . '/' . $book->image }}"
                                    alt="">
                                <p>{{ $book->name }}</p>

                                <i class="fa-brands fa-staylinked"></i>
                            </div>
                            <div class="wrapper">
                                <div class="book">
                                    <div class="front"
                                        style="--img:url('{{ asset('attachments') . '/' . 'booksharing_one' . $book->id . '/' . $book->book_cover }}')">
                                        <h1>{{ $book->book_name }}</h1>
                                        <p>{{ $book->author }}</p>
                                    </div>
                                    <div class="side">
                                        <p>2024</p>
                                    </div>
                                    <div class="back">
                                        <h1>my request</h1>
                                        <p>{{ $book->book_you_want_description }}</p>
                                    </div>
                                    <div class="pages"></div>
                                    <div class="shadow"></div>
                                </div>
                                <button class="creative">
                                    <span class="shadoww"></span>
                                    <span class="edgee"></span>
                                    <a href="{{ route('book.show', [$book->id, $section->id]) }}"><span
                                            class="frontt text">
                                            more detail
                                        </span></a>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="share">

                            <div class="wrapper">
                                <div class="nobook">
                                    @if ($section->booksharing_two_upload == 'none')
                                        @if (!auth('admin')->check())
                                            <button class="sharebookbtn creative">
                                                <span class="shadoww"></span>
                                                <span class="edgee"></span>

                                                <a href="{{ route('book.create', $section->id) }}"><span
                                                        class="frontt text">
                                                        share book
                                                    </span></a>
                                            </button>
                                        @endif
                                    @else
                                        <div class="alert alert-danger" role="alert">
                                            @if (auth('admin')->check())
                                                admin {{ auth::user()->name }} ! you destryed booksharing
                                            @endif
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforelse

                    <div class="link">
                        <i class="fa-solid fa-link"></i>
                    </div>
                    @forelse ($section->booksharingtwo as $book2)
                        <div class="share">
                            <div class="profile">
                                <img src="{{ asset('attachments') . '/' . 'booksharing_two' . $book2->id . '/' . $book2->image }}"
                                    alt="">
                                <p>{{ $book2->name }}</p>
                                <i class="fa-brands fa-staylinked"></i>
                            </div>
                            <div class="wrapper">
                                <div class="book">
                                    <div class="front"
                                        style="--img:url('{{ asset('attachments') . '/' . 'booksharing_two' . $book2->id . '/' . $book2->book_cover }} ')">
                                        <h1>{{ $book2->book_name }}</h1>
                                        <p>{{ $book2->author }}</p>
                                    </div>
                                    <div class="side">
                                        <p>2024</p>
                                    </div>
                                    <div class="back">

                                    </div>
                                    <div class="pages"></div>
                                    <div class="shadow"></div>
                                </div>

                                <button class="creative">
                                    <span class="shadoww"></span>
                                    <span class="edgee"></span>
                                    <a href="{{ route('book.show2', [$book2->id, $section->id]) }}"><span
                                            class="frontt text"> more detail
                                        </span></a>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="share">

                            <div class="wrapper">
                                <div class="nobook">

                                    @if (!auth('admin')->check())
                                        @if ($section->booksharing_one_upload == 'submit' && $section->share_one != Auth::user()->id)
                                            <button class="sharebookbtn creative">
                                                <span class="shadoww"></span>
                                                <span class="edgee"></span>
                                                <a href="{{ route('book.create2', $section->id) }}"><span
                                                        class="frontt text">
                                                        share book
                                                    </span></a>
                                            </button>
                                        @endif
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforelse

                </section>

            </div>
        </div>
    @else
        <div class="booksharing">

            <h1>
                @if (auth('admin')->check())
                    <a href="{{ route('booksharingsection.destroy', $section->id) }}"><i
                            class="fa-solid fa-trash"></i></a>
                @endif
                {{ $section->section_name }}'s sharing <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </h1>
            <div class="container-fluid">
                <section class="book-showcase row">
                    @forelse ($section->booksharingone as $book)
                        <div class="share blur">
                            <div class="profile">
                                <img src="{{ asset('attachments') . '/' . 'booksharing_one' . $book->id . '/' . $book->image }}"
                                    alt="">
                                <p>{{ $book->name }}</p>

                                <i class="fa-brands fa-staylinked"></i>
                            </div>
                            <div class="wrapper">
                                <div class="book">
                                    <div class="front"
                                        style="--img:url('{{ asset('attachments') . '/' . 'booksharing_one' . $book->id . '/' . $book->book_cover }}')">
                                        <h1>{{ $book->book_name }}</h1>
                                        <p>{{ $book->author }}</p>
                                    </div>
                                    <div class="side">
                                        <p>2024</p>
                                    </div>
                                    <div class="back">
                                        <h1>my request</h1>
                                        <p>{{ $book->book_you_want_description }}</p>
                                    </div>
                                    <div class="pages"></div>
                                    <div class="shadow"></div>
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="share">

                            <div class="wrapper">
                                <div class="nobook">
                                    @if ($section->booksharing_two_upload == 'none')
                                        @if (!auth('admin')->check())
                                            <button class="sharebookbtn creative">
                                                <span class="shadoww"></span>
                                                <span class="edgee"></span>

                                                <a href="{{ route('book.create', $section->id) }}"><span
                                                        class="frontt text">
                                                        share book
                                                    </span></a>
                                            </button>
                                        @endif
                                    @else
                                        @if (Auth::user()->id == $section->share_two)
                                            <div class="alert alert-danger" role="alert">
                                                sorry, another user refused your book delete your sharing and start
                                                again


                                            </div>
                                        @else
                                            <div class="alert alert-danger" role="alert">
                                                By deleting the book, the book sharing destroyed.make a new bookshring
                                                section or wait another user to delete his sharing

                                            </div>
                                        @endif
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforelse

                    <div class="link">
                        <i class="fa-solid fa-link"></i>
                    </div>
                    @forelse ($section->booksharingtwo as $book2)
                        <div class="share blur">
                            <div class="profile">
                                <img src="{{ asset('attachments') . '/' . 'booksharing_two' . $book2->id . '/' . $book2->image }}"
                                    alt="">
                                <p>{{ $book2->name }}</p>
                                <i class="fa-brands fa-staylinked"></i>
                            </div>
                            <div class="wrapper">
                                <div class="book">
                                    <div class="front"
                                        style="--img:url('{{ asset('attachments') . '/' . 'booksharing_two' . $book2->id . '/' . $book2->book_cover }} ')">
                                        <h1>{{ $book2->book_name }}</h1>
                                        <p>{{ $book2->author }}</p>
                                    </div>
                                    <div class="side">
                                        <p>2024</p>
                                    </div>
                                    <div class="back">

                                    </div>
                                    <div class="pages"></div>
                                    <div class="shadow"></div>
                                </div>


                            </div>
                        </div>
                    @empty
                        <div class="share">

                            <div class="wrapper">
                                <div class="nobook">

                                    @if (!auth('admin')->check())
                                        @if ($section->booksharing_one_upload == 'submit' && $section->share_one != Auth::user()->id)
                                            <button class="sharebookbtn creative">
                                                <span class="shadoww"></span>
                                                <span class="edgee"></span>
                                                <a href="{{ route('book.create2', $section->id) }}"><span
                                                        class="frontt text">
                                                        share book
                                                    </span></a>
                                            </button>
                                        @endif
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforelse

                </section>

            </div>
        </div>
    @endif
@empty
    <div class="booksharing">
        <div class="nosections">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">no booksharing sections!</h4>
                <p>Add a book sharing section and enjoy sharing books with others</p>

            </div>
        </div>

    </div>
@endforelse
    @endif
@endif

@endsection