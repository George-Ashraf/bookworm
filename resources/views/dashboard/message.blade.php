@extends('layouts.master3')
@section('title')
    dashboard
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection
@section('content')
    <div class="dashboard">

        <div class="product-detail">
            <section id="testimonials">

                <div class="testimonial-heading">
                    <h1>messages</h1>

                </div>

                <div class="testimonial-box-container">

                    @forelse ($contact_us as $message)
                        <div class="testimonial-box">
                            <!--top------------------------->
                            <div class="box-top">
                                <!--profile----->
                                <div class="profile">
                                    <!--img---->

                                    <!--name-and-username-->
                                    <div class="name-user">
                                        <strong>
                                            {{ $message->name }}


                                            <a href="{{ route('about.destroy', $message->id) }}"><i
                                                    class="fa-solid fa-trash"></i></a>
                                        </strong>
                                        <span>{{ $message->email }}</span>
                                        <p></p>
                                    </div>
                                </div>
                                <!--reviews------>
                                <div class="reviews">
                                    @if ($message->reader_id)
                                        <p>{{ $message->user->phone }}</p>
                                        <p>user</p>
                                    @elseif ($message->author_id)
                                    <p>{{ $message->author->phone }}</p>
                                    <p>author</p>
                                    @elseif ($message->bookstore_id)
                                    <p>{{ $message->bookstore->phone }}</p>
                                    <p>bookstore</p>

                                    @endif
                                    <!--Empty star-->
                                </div>
                            </div>
                            <!--Comments---------------------------------------->
                            <div class="client-comment">
                                <p>{{ $message->message }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-danger">
                            no messages
                        </div>
                    @endforelse


                </div>
            </section>
        </div>



    </div>
@endsection
@section('js')
    <script>
        function togglemenu() {
            let navigation = document.querySelector(".navigation")
            let toggle = document.querySelector(".toggle")

            navigation.classList.toggle('active')
            toggle.classList.toggle('active')


        }
    </script>
@endsection
