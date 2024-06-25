@extends('layouts.master3')
@section('title')
    dashboard
@endsection
@section('content')
    <div class="dashboard">
        <div class="countbox">
            <div class="container-fluid">
                <div class="row">
                    <div class="count col-lg-2">
                        <div class="icon">
                            <i class="fa-solid fa-truck"></i>
                        </div>
                        <div class="number">
                            <h4>delivery man</h4>
                            <p>{{ $countman }}</p>
                        </div>
                    </div>
                    <div class="count col-lg-2">
                        <div class="icon">
                            <i class="fa-solid fa-handshake"></i>
                                                </div>
                        <div class="number">
                            <h4 class="small"> shared books delivered</h4>
                            <p>{{$countdelivery}}</p>
                        </div>
                    </div>
                    <div class="count col-lg-2">
                        <div class="icon">
                            <i class="fa-solid fa-book"></i>
                                                </div>
                        <div class="number">
                            <h4 class="small">purchased book delivered</h4>
                            <p>{{$countddeliverypurchased}}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">
                        @if ($errors->any() && auth('admin')->check())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>admin {{ Auth::user()->name }}!</strong> delivery man exist in order ,can't delete
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                        <div class="card-body table-responsive">

                            <h5 class="card-title"> <button class="makesection creative" type="button" data-toggle="modal"
                                    data-target="#modelsection">
                                    <span class="shadoww"></span>
                                    <span class="edgee"></span>
                                    <span class="frontt text">add delivery man </span>
                                </button>
                                delivery man
                            </h5>

                            <div class="modal fade" id="modelsection" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method='POST' action="{{ route('man.store') }}">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Add delivery man </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">



                                                <div class="form-group">
                                                    <label for="validationDefault05">name </label>
                                                    <input type="text"
                                                        class="@error('name') is-invalid @enderror form-control"
                                                        value="{{ old('name') }}" name="name">
                                                    @error('name')
                                                        <span class="invalid-feedbackk">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="validationDefault05">age</label>
                                                    <input type="text"
                                                        class="@error('age') is-invalid @enderror form-control"
                                                        value="{{ old('age') }}" name="age">
                                                    @error('age')
                                                        <span class="invalid-feedbackk">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="validationDefault05">phone</label>
                                                    <input type="text"
                                                        class="@error('phone') is-invalid @enderror form-control"
                                                        value="{{ old('phone') }}" name="phone">
                                                    @error('phone')
                                                        <span class="invalid-feedbackk">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="creative close" data-dismiss="modal">
                                                    <span class="shadoww"></span>
                                                    <span class="edgee"></span>
                                                    <span class="frontt text"> close </span>
                                                </button>
                                                <button type="submit" class="creative">
                                                    <span class="shadoww"></span>
                                                    <span class="edgee"></span>
                                                    <span class="frontt text"> submit </span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Table with stripped rows -->
                            <table class="datatable table  table-striped" id="myTable ">
                                <thead>
                                    <tr>
                                        <th> #</th>

                                        <th> name</th>
                                        <th>age</th>
                                        <th>phone</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mans as $man)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $man->name }}</td>
                                            <td>{{ $man->age }}</td>
                                            <td>{{ $man->phone }}</td>
                                            <td>

                                                <i class="fa-solid fa-pen text-primary" type="button" data-toggle="modal"
                                                    data-target="#update{{ $man->id }}"></i>


                                                <a href="{{ route('man.destroy', $man->id) }}">
                                                    <i class="fa-solid fa-trash text-danger "></i>

                                                </a>
                                            </td>


                                        </tr>
                                        <div class="modal fade" id="update{{ $man->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form method='POST' action="{{ route('man.update', $man->id) }}">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">update
                                                                delivery
                                                                man </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">



                                                            <div class="form-group">
                                                                <label for="validationDefault05">name </label>
                                                                <input type="text"
                                                                    class="@error('name') is-invalid @enderror form-control"
                                                                    value="{{ $man->name }}" name="name">
                                                                @error('name')
                                                                    <span class="invalid-feedbackk">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationDefault05">age</label>
                                                                <input type="text"
                                                                    class="@error('age') is-invalid @enderror form-control"
                                                                    value="{{ $man->age }}" name="age">
                                                                @error('age')
                                                                    <span class="invalid-feedbackk">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationDefault05">phone</label>
                                                                <input type="text"
                                                                    class="@error('phone') is-invalid @enderror form-control"
                                                                    value="{{ $man->phone }}" name="phone">
                                                                @error('phone')
                                                                    <span class="invalid-feedbackk">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="creative close"
                                                                data-dismiss="modal">
                                                                <span class="shadoww"></span>
                                                                <span class="edgee"></span>
                                                                <span class="frontt text"> close </span>
                                                            </button>
                                                            <button type="submit" class="creative">
                                                                <span class="shadoww"></span>
                                                                <span class="edgee"></span>
                                                                <span class="frontt text"> submit </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="alert alert-danger text-center">
                                            No Data
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
                            <h5 class="card-title">add booksharing one delivery </h5>



                            <!-- Table with stripped rows -->
                            <table class="datatable table  table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> name</th>
                                        <th>book name</th>
                                        <th>format</th>


                                        <th>add delivery man</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($booksharing_one as $book)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>

                                            <td>{{ $book->name }}</td>
                                            <td>{{ $book->book_name }}</td>
                                            <td>{{ $book->format }}</td>
                                            <td>
                                                @if ($book->delivery == 'none')
                                                    <a
                                                        href="{{ route('delivery.create', [$book->id, $book->BS_section_id]) }}">
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
                                            No Data
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
                            <h5 class="card-title">add booksharing two delivery </h5>



                            <!-- Table with stripped rows -->
                            <table class="datatable table  table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> name</th>
                                        <th>book name</th>
                                        <th>format</th>


                                        <th>add delivery man</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($booksharing_two as $book2)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>

                                            <td>{{ $book2->name }}</td>
                                            <td>{{ $book2->book_name }}</td>
                                            <td>{{ $book2->format }}</td>
                                            <td>
                                                @if ($book2->delivery == 'none')
                                                    <a
                                                        href="{{ route('delivery.create2', [$book2->id, $book2->BS_section_id]) }}">
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
                                            No Data
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
                            <h5 class="card-title"> booksharing delivery </h5>



                            <!-- Table with stripped rows -->
                            <table class="datatable table  table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>from street</th>
                                        <th>from city</th>
                                        <th>phone</th>
                                        <th> booksharing section</th>
                                        <th> from booksharing one</th>
                                        <th> to booksharing two</th>
                                        <th>to street2</th>
                                        <th>from city2</th>
                                        <th> phone2</th>
                                        <th> from booksharing two</th>
                                        <th> to booksharing one</th>
                                        <th> delivery man </th>
                                        <th> admin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($delivery as $deliver)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>

                                            <td>{{ $deliver->street }}</td>
                                            <td>{{ $deliver->city }}</td>
                                            <td>{{ $deliver->phone }}</td>
                                            <td>{{ $deliver->booksharingsectionid->section_name }}</td>
                                            <td>{{ $deliver->frombooksharingone->name }}</td>
                                            <td>{{ $deliver->tobooksharingtwo->name }}</td>
                                            <td>{{ $deliver->street2 }}</td>
                                            <td>{{ $deliver->city2 }}</td>
                                            <td>{{ $deliver->phone2 }}</td>
                                            <td>{{ $deliver->frombooksharingtwo->name }}</td>
                                            <td>{{ $deliver->tobooksharingone->name }}</td>
                                            <td>{{ $deliver->deliverymanid->name }}</td>
                                            <td>{{ $deliver->adminid->name }}</td>


                                        </tr>

                                    @empty
                                        <div class="alert alert-danger text-center">
                                            No Data
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
                            <h5>add purchased book delivery</h5>



                            <!-- Table with stripped rows -->
                            <table class="datatable table  table-striped" id="myTable ">
                                <thead>
                                    <tr>
                                        <th>#</th>
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
                                            <td>{{ $loop->index + 1 }}</td>

                                            <td>{{ $book->name }}</td>

                                            <td>{{ $book->book_name }}</td>

                                            <td> <img
                                                    src="{{ asset('attachments') . '/' . 'book_panel' . $book->book_id . '/' . $book->book_cover }}">
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
                                        <th>#</th>
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
                                            <td>{{ $loop->index + 1 }}</td>
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
