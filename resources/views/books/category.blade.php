@extends('layouts.master')
@section('title')
    books
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection
@section('content')
    <div class="books">



<p class="approve">{{$category->category_name}}</p>




        <div class="container-fluid">
            <div class="row">
                @forelse ($product as $pro)
                    <div class="cardd col-lg-3 col-md-3">
                        <a href="{{ route('product.show', $pro->id) }}">
                            <div class="imgbx">
                                <img src="{{ asset('attachments') . '/' .'book_panel'.$pro->id.'/' .$pro->book_cover }}"
                                    alt="">
                                <ul class="action">
                                    <li>
                                        <a href="{{ route('product.show', $pro->id) }}">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                            <span>Add to cart</span>
                                        </a>

                                    </li>
                                    <li>
                                        <a href="{{ route('product.show', $pro->id) }}">
                                            <i class="fa-solid fa-eye"></i>
                                            <span>view details</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </a>
                        <div class="contant">
                            <a href="{{ route('product.show', $pro->id) }}" class="productname">
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
                        no books
                    </div>
                @endforelse



            </div>
        </div>


    </div>
@endsection
@section('js')
@endsection
