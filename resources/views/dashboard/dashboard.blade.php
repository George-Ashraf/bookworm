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
                            <i class="fa-regular fa-user"></i>
                        </div>
                        <div class="number">
                            <h4>user</h4>
                            <p>{{ $user }}</p>
                        </div>
                    </div>
                    <div class="count col-lg-2">
                        <div class="icon">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <div class="number">
                            <h4>premium user</h4>
                            <p>{{ $premium }}</p>
                        </div>
                    </div>
                    <div class="count col-lg-2">
                        <div class="icon">
                            <i class="fa-solid fa-book-open-reader"></i>
                        </div>
                        <div class="number">
                            <h4>author</h4>
                            <p>{{ $author }}</p>
                        </div>
                    </div>
                    <div class="count col-lg-2">
                        <div class="icon">
                            <i class="fa-solid fa-shop"></i>
                        </div>
                        <div class="number">
                            <h4>bookstore</h4>
                            <p>{{ $bookstore }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="countbox">
            <div class="container-fluid">
                <div class="row">
                    <div class="count col-lg-2">
                        <div class="icon">
                            <i class="fa-regular fa-handshake"></i>
                                                </div>
                        <div class="number">
                            <h4>shared book</h4>
                            <p>{{ $shared_book1 + $shared_book2 }}</p>
                        </div>
                    </div>
                    <div class="count col-lg-2">
                        <div class="icon">
                            <i class="fa-solid fa-swatchbook"></i>
                                                </div>
                        <div class="number">
                            <h4>book in website</h4>
                            <p>{{ $all_book }}</p>
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

                                users
                            </h5>



                            <!-- Table with stripped rows -->
                            <table class=" table  table-striped" id="myTable ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> name</th>
                                        <th>email</th>
                                        <th>phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $man)
                                        <tr>
                                        <td>{{ $loop->index + 1 }}</td>

                                            <td>{{ $man->name }}</td>
                                            <td>{{ $man->email }}</td>
                                            <td>{{ $man->phone }}</td>






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

                                premium users
                            </h5>



                            <!-- Table with stripped rows -->
                            <table class=" table  table-striped" id="myTable ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> name</th>
                                        <th>email</th>
                                        <th>phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($preusers as $man)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>

                                            <td>{{ $man->name }}</td>
                                            <td>{{ $man->email }}</td>
                                            <td>{{ $man->phone }}</td>






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

                                authors
                            </h5>



                            <!-- Table with stripped rows -->
                            <table class=" table  table-striped" id="myTable ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> name</th>
                                        <th>email</th>
                                        <th>type of write</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($authors as $man)
                                        <tr>
                                        <td>{{ $loop->index + 1 }}</td>

                                            <td>{{ $man->name }}</td>
                                            <td>{{ $man->email }}</td>
                                            <td>{{ $man->type_of_write }}</td>






                                        </tr>

                                    @empty
                                        <div class="alert alert-danger text-center">
                                            No authors
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

                                bookstores
                            </h5>



                            <!-- Table with stripped rows -->
                            <table class=" table  table-striped" id="myTable ">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <th> name</th>
                                        <th>bookstore name</th>
                                        <th>address</th>
                                        <th>email</th>
                                        <th>phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookstores as $bookstore)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $bookstore->name }}</td>
                                            <td>{{ $bookstore->bookstore_name }}</td>
                                            <td>{{ $bookstore->address }}</td>
                                            <td>{{ $bookstore->email }}</td>
                                            <td>{{ $bookstore->phone }}</td>






                                        </tr>

                                    @empty
                                        <div class="alert alert-danger text-center">
                                            No bookstores
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
