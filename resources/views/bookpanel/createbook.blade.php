@extends('layouts.master2')
@section('title')
    add book
@endsection

@section('content')
    <div class="allforms">
        <h1>add a book <i class="fa-solid fa-arrow-up-right-from-square"></i></h1>
        @if (auth('author')->check() || auth('bookstore')->check())
        <p class="text-danger">note:we will take 10% from you for every book purchased</p>

        @endif
        <form class="container-fluid col-lg-7" method="POST" action="{{ route('all_book.store') }}"
            enctype="multipart/form-data">
            @csrf


            <div class="form-row">


                <div class="form-group col-md-6">
                    <label>book cover image</label>
                    <input type="file" name="book_cover"
                        class="@error('book_cover') is-invalid @enderror form-control-file" value="{{ old('book_cover') }}">
                    @error('book_cover')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">format</label>
                        <select name="format" class="@error('format') is-invalid @enderror form-control"
                            value="{{ old('format') }}"id="exampleFormControlSelect1">
                            <option selected disabled>chosse</option>
                            <option value="hard copy">Hard Copy</option>
                            <option value="soft copy">Soft Copy</option>
                            <option value="hard copy & soft copy">both</option>


                        </select>
                    </div>
                    @error('format')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">book name</label>
                    <input name="book_name" class="@error('book_name') is-invalid @enderror form-control"
                        value="{{ old('book_name') }}">

                    @error('book_name')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail4">hard copy price</label>
                    <input type="text" name="price_hard" class="@error('price_hard') is-invalid @enderror form-control"
                        value="{{ old('price_hard') }}">
                    @error('price_hard')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">soft copy price</label>
                    <input type="text" name="price_soft" class="@error('price_soft') is-invalid @enderror form-control"
                        value="{{ old('price_soft') }}">
                    @error('price_soft')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">author</label>
                    <input name="author" class="@error('author') is-invalid @enderror form-control"
                        value="{{ auth()->user()->name}}">

                    @error('author')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">category</label>
                    <select name="category" class="@error('category') is-invalid @enderror form-control" value="{{ old('category') }}">
                        <option disabled selected>chosse</option>

                        @foreach ($category as $cate)
                        <option value="{{$cate->id}}">{{$cate->category_name}}</option>

                        @endforeach
                    </select>
                    @error('category')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-row">

                <div class="form-group col-md-6 mb-3">
                    <label>book file</label>
                    <input type="file" name="book_file"
                        class="@error('book_file') is-invalid @enderror form-control-file" value="{{ old('book_file') }}">
                    @error('book_file')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationDefault03">language</label>
                    <input type="text" name="language" class="@error('language') is-invalid @enderror form-control"
                        value="{{ old('language') }}">

                    @error('language')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">book description</label>
                <textarea name="description" class="@error('description') is-invalid @enderror form-control" rows="3">
                    {{ old('description') }}
                </textarea>
                @error('description')
                    <span class="invalid-feedbackk">
                        {{ $message }}
                    </span>
                @enderror
            </div>


            <button type="submit" class="creative">
                <span class="shadoww"></span>
                <span class="edgee"></span>
                <span class="frontt text submit">add</span>
            </button>
        </form>
    </div>
@endsection
