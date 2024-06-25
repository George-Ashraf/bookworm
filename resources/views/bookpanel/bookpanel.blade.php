@extends('layouts.master')
@section('title')
    books
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection
@section('content')
    <div class="books">
        <a href="{{ route('all_book.create') }}">
            <button type="submit" class="creative">
                <span class="shadoww"></span>
                <span class="edgee"></span>
                <span class="frontt text submit">add book</span>
            </button>
        </a>
        @if (auth('admin')->check())
        <p class="approve">approved book</p>

        @endif

        <div class="container-fluid">
            <div class="row">

                @forelse ($product as $pro)
                    <div class="cardd col-lg-3 col-md-3">
                        <a href="{{route('all_book.show',$pro->id)}}">

                        <div class="imgbx">
                            <img src="{{ asset('attachments').'/' .'book_panel'.$pro->id .'/' . $pro->book_cover  }}" alt="">
                            <ul class="action">
                                <li>
                                    <a href="{{route('all_book.show',$pro->id)}}">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span>Add to cart</span>
                                    </a>

                                </li>
                                <li>
                                    <a href="{{ route('all_book.show', $pro->id) }}">
                                        <i class="fa-solid fa-eye"></i>
                                        <span>view details</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </a>

                        <div class="contant">
                            <a href="{{route('all_book.show',$pro->id)}}" class="productname">
                                <h3>{{ $pro->book_name }}</h3>
                            </a>
                            <div class="price_rating_author">


                                <p>{{ $pro->author }}</p>
                                @if ($pro->format == 'hard copy & soft copy')
                                    <h2>{{ $pro->pricesoft }} LE</h2>
                                @elseif ($pro->format == 'soft copy')
                                    <h2>{{ $pro->pricesoft }} LE</h2>
                                @else
                                    <h2>{{ $pro->pricehard }} LE</h2>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-danger">
                        no approved books
                    </div>
                @endforelse



            </div>
        </div>
        @if (auth('admin')->check())
        <p class="approve"> not approved book</p>

        <div class="container-fluid">
            <div class="row">
                @forelse ($pri_product as $pro)
                    <div class="cardd col-lg-3 col-md-3">
                        <a href="{{route('all_book.show',$pro->id)}}">

                        <div class="imgbx">
                            <img src="{{ asset('attachments').'/' .'book_panel'.$pro->id .'/' . $pro->book_cover  }}" alt="">
                            <ul class="action">
                                <li>
                                    <a href="{{route('all_book.show',$pro->id)}}">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span>Add to cart</span>
                                    </a>

                                </li>
                                <li>
                                    <a href="{{ route('all_book.show', $pro->id) }}">
                                        <i class="fa-solid fa-eye"></i>
                                        <span>view details</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <a href=""></a>
                        <div class="contant">
                            <a href="{{route('all_book.show',$pro->id)}}" class="productname">
                                <h3>{{ $pro->book_name }}</h3>
                            </a>
                            <div class="price_rating_author">


                                <p>{{ $pro->author }}</p>
                                @if ($pro->format == 'hard copy & soft copy')
                                    <h2>{{ $pro->pricesoft }} LE</h2>
                                @elseif ($pro->format == 'soft copy')
                                    <h2>{{ $pro->pricesoft }} LE</h2>
                                @else
                                    <h2>{{ $pro->pricehard }} LE</h2>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-danger">
                        no not approved books
                    </div>
                @endforelse
            </div>
        </div>
        @endif

    </div>
    @if (!auth('admin')->check())
        <div class="dashboard revenue">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card ">

                            <div class="card-body table-responsive">
                                <h5>revenue</h5>



                                <!-- Table with stripped rows -->
                                @if (auth('author')->check())
                                    <table class=" table  table-striped" id="myTable ">
                                        <thead>
                                            <tr>
                                                <th>book name</th>
                                                <th>your revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($revenue as $book)
                                                <tr>


                                                    <td>
                                                        <a href="{{ route('all_book.show', $book->book_id) }}">

                                                            {{ $book->book_name }}
                                                        </a>

                                                    </td>
                                                    <td>{{ $book->author_revenue }}</td>


                                                </tr>

                                            @empty
                                                <div class="alert alert-danger text-center">
                                                    No revenue
                                                </div>
                                            @endforelse

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>total</td>
                                                <td>{{ $countrevenue }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                @elseif (auth('bookstore')->check())
                                    <table class=" table  table-striped" id="myTable ">
                                        <thead>
                                            <tr>
                                                <th>book name</th>
                                                <th>your revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($revenue as $book)
                                                <tr>


                                                    <td>
                                                        <a href="{{ route('all_book.show', $book->book_id) }}">

                                                            {{ $book->book_name }}
                                                        </a>

                                                    </td>
                                                    <td>{{ $book->bookstore_revenue }}</td>


                                                </tr>

                                            @empty
                                                <div class="alert alert-danger text-center">
                                                    No revenue
                                                </div>
                                            @endforelse

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>total</td>
                                                <td>{{ $countrevenue }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                @endif



                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('js')
@endsection
