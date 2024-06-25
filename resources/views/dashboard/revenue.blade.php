@extends('layouts.master3')
@section('title')
    dashboard
@endsection
@section('css')
@endsection
@section('content')
    <div class="dashboard">

        <div class="countbox">
            <div class="container-fluid">
                <div class="row">
                    <div class="count col-lg-2">
                        <div class="icon">
                            <i class="fa-solid fa-dollar-sign"></i>
                        </div>
                        <div class="number">
                            <h4 class="small">revenue from purchased book ({{ $countrevenue }})</h4>
                            <p>{{ $revenue }} LE</p>
                        </div>
                    </div>
                    <div class="count col-lg-2">
                        <div class="icon">
                            <i class="fa-regular fa-handshake"></i>
                        </div>
                        <div class="number">
                            <h4 class="small">revenue from booksharing
                                ({{ $countbooksharing_one + $countbooksharing_two }})</h4>
                            <p>{{ $booksharing_one + $booksharing_two }} LE</p>


                        </div>
                    </div>
                    <div class="count col-lg-2">
                        <div class="icon">
                            <i class="fa-solid fa-coins"></i>
                        </div>
                        <div class="number">
                            <h4>premium service ({{ $countpremium }})</h4>
                            <p>{{ $premium }} LE</p>
                        </div>
                    </div>
                    <div class="count col-lg-2">
                        <div class="icon">
                            <i class="fa-solid fa-shop"></i>
                        </div>
                        <div class="number">
                            <h4>offline seminar ({{ $countseminar }})</h4>
                            <p>{{ $seminar }} LE</p>
                        </div>
                    </div>
                    <div class="count col-lg-2">
                        <div class="icon">
                            <i class="fa-solid fa-sack-dollar"></i>
                        </div>
                        <div class="number">
                            <h4>total</h4>
                            <p>{{ $premium + $seminar + $booksharing_one + $booksharing_two + $revenue }} LE</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">

                        <div class="card-body table-responsive">

                            <h5 class="card-title">

                                revenue from purchased book
                            </h5>



                            <!-- Table with stripped rows -->
                            <table class=" table  table-striped" id="revenue">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>book name</th>
                                        <th>revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($revenuee as $book)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>

                                            <td> <a
                                                    href="{{ route('all_book.show', $book->book_id) }}">{{ $book->book_name }}</a>
                                            </td>
                                            <td>{{ $book->admin_revenue }}</td>






                                        </tr>

                                    @empty
                                        <div class="alert alert-danger text-center">
                                            No users
                                        </div>
                                    @endforelse

                                </tbody>
                            </table>


                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">

                        <div class="card-body table-responsive">

                            <h5 class="card-title">

                                revenue from booksharing_one
                            </h5>



                            <!-- Table with stripped rows -->
                            <table class=" table  table-striped" id="revenue2 ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>book name</th>
                                        <th>price</th>


                                    </tr>
                                </thead>
                                <tbody>



                                    @forelse ($book_sharing_one_payment as $book)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>

                                            <td><a
                                                    href="{{ route('book.show', [$book->booksharing_one, $book->BS_section_id]) }}">{{ $book->book_name }}</a>
                                            </td>

                                            <td>{{ $book->price }}</td>







                                        </tr>

                                    @empty
                                        <div class="alert alert-danger text-center">
                                            No books
                                        </div>
                                    @endforelse

                                </tbody>
                            </table>


                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">

                        <div class="card-body table-responsive">

                            <h5 class="card-title">

                                revenue from booksharing_two
                            </h5>



                            <!-- Table with stripped rows -->
                            <table class=" table  table-striped" id="revenue3">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>book name</th>
                                        <th>price</th>


                                    </tr>
                                </thead>
                                <tbody>



                                    @forelse ($book_sharing_two_payment as $book)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>

                                            <td><a
                                                    href="{{ route('book.show2', [$book->booksharing_two, $book->BS_section_id]) }}">{{ $book->book_name }}</a>
                                            </td>
                                            <td> {{ $book->price }}</td>









                                        </tr>

                                    @empty
                                        <div class="alert alert-danger text-center">
                                            No books
                                        </div>
                                    @endforelse

                                </tbody>
                            </table>


                        </div>
                    </div>

                </div>
            </div>
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

