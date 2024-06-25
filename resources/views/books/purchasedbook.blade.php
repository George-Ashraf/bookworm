@extends('layouts.master')
@section('title')
    purchased book
@endsection
@section('content')
    <div class="dashboard purchase">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">

                        <div class="card-body table-responsive">
                            <h5>purchased book</h5>



                            <!-- Table with stripped rows -->
                            <table class="datatable table  table-striped" id="myTable ">
                                <thead>
                                    <tr>
                                        <th> book_name</th>
                                        <th>book_cover</th>
                                        <th>language</th>
                                        <th>author</th>
                                        <th>price</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($purchased as $book)
                                        <tr>


                                            <td>{{ $book->book_name }}</td>
                                            <td>   <img src="{{ asset('attachments') . '/' .'book_panel'.$book->book_id.'/' .$book->book_cover }}"></td>
                                            <td>{{ $book->language }}</td>
                                            <td>{{ $book->author }}</td>
                                            <td>{{ $book->price }}</td>
                                            <td>
                                                @if ($book->format=='soft')
                                                <a href="{{route('download.purchased',[$book->book_file,$book->book_id])}}"><i class="fa-solid fa-download"></i></a>

                                                @endif
                                                <a href="{{route('product.show',$book->book_id)}}"><i class="fa-solid fa-eye"></i></a>

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

    </div>
@endsection
