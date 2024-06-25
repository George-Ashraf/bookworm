@extends('layouts.master2')
@section('title')
    update book
@endsection

@section('content')
    <div class="allforms">
        <h1>update a book <i class="fa-solid fa-file-pen"></i></h1>
        <form class="container-fluid col-lg-7" method="POST" action="{{ route('book.update2',[$booksharing_two->id,$booksharingsection->id]) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" disabled value=" {{$booksharingsection->id}}"  name="BS_section_id">

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">your name</label>
                    <input type="text"  name="name" value="{{$booksharing_two->name}}" class="@error('name') is-invalid @enderror form-control" value="{{ old('name') }}">


                    @error('name')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">book name</label>
                    <input name="book_name"  class="@error('book_name') is-invalid @enderror form-control" value="{{ $booksharing_two->book_name }}">

                    @error('book_name')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-row">

                <div class="form-group col-md-4">
                    <label >your image</label>
                    <input type="file" name="image" class="@error('image') is-invalid @enderror form-control-file" value="{{ old('image') }}">
                    <embed src="{{ URL::asset('attachments/'.'booksharing_two'.$booksharing_two->id.'/' .$booksharing_two->image) }}" type="application/pdf"   height="150px" width="210px">
                    @error('image')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label >book cover image</label>
                    <input type="file" name="book_cover"class="@error('book_cover') is-invalid @enderror form-control-file" value="{{ old('book_cover') }}">
                    <embed src="{{ URL::asset('attachments/'.'booksharing_two'.$booksharing_two->id.'/' .$booksharing_two->book_cover) }}" type="application/pdf"   height="150px" width="210px">

                    @error('book_cover')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label >book file</label>
                    <input type="file" name="book_file"class="@error('book_file') is-invalid @enderror form-control-file" value="{{ old('book_file') }}">
                    <embed src="{{ URL::asset('attachments/'.'booksharing_two'.$booksharing_two->id.'/' . $booksharing_two->book_file) }}" type="application/pdf"   height="150px" width="210px">

                    @error('book_file')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">author</label>
                    <input name="author" class="@error('author') is-invalid @enderror form-control" value="{{$booksharing_two->author }}">

                    @error('author')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">type of the book</label>
                    <input name="type_of_book" class="@error('type_of_book') is-invalid @enderror form-control" value="{{ $booksharing_two->type_of_book }}">

                    @error('type_of_book')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">format</label>
                        <select name="format" class="@error('format') is-invalid @enderror form-control" value="{{ old('format') }}"id="exampleFormControlSelect1">
                            <option selected disabled>chosse</option>
                            <option value="hard copy" {{$booksharing_two->format == 'hard copy' ?'selected':''}}>Hard Copy</option>
                            <option value="soft copy"{{$booksharing_two->format == 'soft copy' ?'selected':''}}>Soft Copy</option>

                        </select>
                    </div>
                    @error('format')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault03">language</label>
                    <input type="text" name="language" class="@error('language') is-invalid @enderror form-control" value="{{ $booksharing_two->language }}">

                    @error('language')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault05">used around</label>
                    <input type="text" name="used_around"
                        class="@error('used_around') is-invalid @enderror form-control" value="{{ $booksharing_two->used_around }}">

                    @error('used_around')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">book description</label>
                <textarea name="description" class="@error('description') is-invalid @enderror form-control"  rows="3">
                    {{ $booksharing_two->description  }}
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
                <span class="frontt text submit">update</span>
            </button>
        </form>
    </div>
@endsection
