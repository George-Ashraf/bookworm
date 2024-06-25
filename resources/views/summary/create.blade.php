@extends('layouts.master2')
@section('title')
    add summary
@endsection

@section('content')
    <div class="allforms">
        <h1>add summary <i class="fa-solid fa-arrow-up-right-from-square"></i></h1>

        <form class="container-fluid col-lg-7" method="POST" action="{{ route('summary.store') }}" enctype="multipart/form-data">
            @csrf

<input type="hidden" name="book_id" value="{{$book->id}}">
<input type="hidden" name="summary" value="{{$book->summary}}">


    <div class="form-group col-md-9">
        <label for="exampleFormControlSelect1">format</label>
        <select name="format" class="@error('format') is-invalid @enderror form-control"
            value="{{ old('format') }}"id="exampleFormControlSelect1">
            <option selected disabled>chosse</option>
            <option value="written_summary">written summary</option>
            <option value="video_summary">video summary</option>
            <option value="voice_summary">voice summary</option>
            <option value="written_summary">written summary</option>
            <option value="written_summary&video_summary">written_summary & video_summary</option>
            <option value="written_summary&voice_summary">written_summary & voice_summary</option>
            <option value="video_summary&voice_summary">video_summary & voice_summary</option>



            <option value="written_summary&video_summary&voice_summary">all</option>



        </select>
    </div>
    @error('format')
        <span class="invalid-feedbackk">
            {{ $message }}
        </span>
    @enderror

                <div class="form-group col-md-9">
                    <label>written summary</label>
                    <input type="file" name="written_summary"
                        class="@error('written_summary') is-invalid @enderror form-control-file" value="{{ old('written_summary') }}">
                    @error('written_summary')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-9">
                    <label>video summary</label>
                    <input type="file" name="video_summary"
                        class="@error('video_summary') is-invalid @enderror form-control-file" value="{{ old('video_summary') }}">
                    @error('video_summary')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-9">
                    <label>voice summary</label>
                    <input type="file" name="voice_summary"
                        class="@error('voice_summary') is-invalid @enderror form-control-file" value="{{ old('voice_summary') }}">
                    @error('voice_summary')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-9">
                    <label>novel film link</label>
                    <input type="text" name="novel_film_link"
                        class="@error('novel_film_link') is-invalid @enderror form-control" value="{{ old('novel_film_link') }}">
                    @error('novel_film_link')
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
