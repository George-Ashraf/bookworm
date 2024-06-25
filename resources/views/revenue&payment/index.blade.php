@extends('layouts.master3')
@section('title')
    dashboard
@endsection
@section('content')
    <div class="dashboard">

    
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">

                        <div class="card-body table-responsive">
                            <h5>add purchased book delivery</h5>



                            <!-- Table with stripped rows -->
                            <table class="datatable table  table-striped" id="myTable ">
                                <thead>
                                    <tr>
                                        <th> user name</th>

                                        <th> book_name</th>

                                        <th>book_cover</th>
                                        <th>format</th>
                                        <th>author</th>
                                        <th>price</th>
                                        <th>add delivery man</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($purchased as $book)
                                        <tr>

                                            <td>{{ $book->name }}</td>

                                            <td>{{ $book->book_name }}</td>

                                            <td> <img
                                                    src="{{ asset('attachments/author_book_cover') . '/' . $book->book_cover }}">
                                            </td>
                                            <td>{{ $book->format }}</td>
                                            <td>{{ $book->author }}</td>
                                            <td>{{ $book->price }}</td>
                                            <td>
                                                @if ($book->delivery == 'none')
                                                    <a href="{{ route('delivery.create3', $book->payment_book_id) }}">
                                                        <i class="fa-solid fa-person-circle-plus"></i>
                                                    </a>
                                                @else
                                                    <p class="text-success"><i class="fa-solid fa-circle-check"></i>
                                                        deliverd</p>
                                                @endif


                                            </td>


                                        </tr>

                                    @empty
                                        <div class="alert alert-danger text-center">
                                            No books purchased
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
                            <h5> book delivery</h5>



                            <!-- Table with stripped rows -->
                            <table class="datatable table  table-striped" id="myTable ">
                                <thead>
                                    <tr>

                                        <th>street</th>
                                        <th> city</th>
                                        <th>phone</th>
                                        <th>book name</th>
                                        <th>delivery man</th>
                                        <th>admin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($book_delivery as $book)
                                        <tr>

                                            <td>{{ $book->street }}</td>

                                            <td>{{ $book->city }}</td>


                                            <td>{{ $book->phone }}</td>
                                            <td>{{ $book->book->book_name }}</td>
                                            <td>{{ $book->man->name }}</td>
                                            <td>{{ $book->admin->name }} </td>


                                        </tr>

                                    @empty
                                        <div class="alert alert-danger text-center">
                                            No delivery book
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
