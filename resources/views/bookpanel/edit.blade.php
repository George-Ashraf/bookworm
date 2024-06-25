@extends('layouts.master2')
@section('title')
    edit book
@endsection

@section('content')
    <div class="allforms">
        <h1>edit a book <i class="fa-solid fa-pen-to-square"></i></h1>
        <p class="text-danger">note:we will take 10% from you for every book purchased</p>
        <form class="container-fluid col-lg-7" method="POST" action="{{ route('all_book.update',$book->id) }}"
            enctype="multipart/form-data">
            @csrf


            <div class="form-row">


                <div class="form-group col-md-6">
                    <label>book cover image</label>
                    <input type="file" name="book_cover"
                        class="@error('book_cover') is-invalid @enderror form-control-file" value="{{ old('book_cover') }}">
                    <embed src="{{ URL::asset('attachments/'.'book_panel'.$book->id.'/' .$book->book_cover) }}" type="application/pdf"   height="250px" width="250px">

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
                            <option value="hard copy" {{$book->format == 'hard copy' ?'selected':''}}>Hard Copy</option>
                            <option value="soft copy" {{$book->format == 'soft copy' ?'selected':''}}>Soft Copy</option>
                            <option value="hard copy & soft copy" {{$book->format == 'hard copy & soft copy' ?'selected':''}}>both</option>


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
                        value="{{$book->book_name}}">

                    @error('book_name')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail4">hard copy price</label>
                    <input type="text" name="price_hard" class="@error('price_hard') is-invalid @enderror form-control"
                        value="{{ $book->pricehard }}">
                    @error('price_hard')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">soft copy price</label>
                    <input type="text" name="price_soft" class="@error('price_soft') is-invalid @enderror form-control"
                        value="{{ $book->pricesoft }}">
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
                        value="{{ $book->author}}">

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
                        <option value="{{ $cate->id }}" {{$cate->id == $book->category_id ? 'selected' : ""}}>{{$cate->category_name}}</option>

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
                    <embed src="{{ URL::asset('attachments/'.'book_panel'.$book->id.'/' .$book->book_file)  }}" type="application/pdf"   height="150px" width="210px">

                    @error('book_file')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationDefault03">language</label>
                    <input type="text" name="language" class="@error('language') is-invalid @enderror form-control"
                        value="{{ $book->language }}">

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
                    {{ $book->description}}
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
