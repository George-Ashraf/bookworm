@extends('layouts.master2')
@section('title')
    update summary
@endsection

@section('content')
    <div class="allforms">
        <h1>update summary <i class="fa-solid fa-arrow-up-right-from-square"></i></h1>

        <form class="container-fluid col-lg-7" method="POST" action="{{ route('summary.update',$summary->id) }}" enctype="multipart/form-data">
            @csrf





                <div class="form-group col-md-9">
                    <label>written summary</label>
                    <input type="file" name="written_summary"
                        class="@error('written_summary') is-invalid @enderror form-control-file" value="{{ old('written_summary') }}">
                    @error('written_summary')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                    <embed src="{{ URL::asset('attachments/'.'summary'.$summary->id.'/'. $summary->written_summary) }}" type="application/pdf"   height="150px" width="210px">

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
                    <embed src="{{ URL::asset('attachments/'.'summary'.$summary->id.'/'. $summary->video_summary) }}" type="application/pdf"   height="150px" width="210px">

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


               
                        <audio controls>
                            <source src="{{ URL::asset('attachments/'.'summary'.$summary->id.'/'. $summary->voice_summary) }}" type="audio/mpeg">

                          </audio>
                </div>
                <div class="form-group col-md-9">
                    <label>novel film link</label>
                    <input type="text" name="novel_film_link"
                        class="@error('novel_film_link') is-invalid @enderror form-control" value="{{ $summary->novel_film_link }}">
                    @error('novel_film_link')
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
