@extends('layouts.master2')
@section('title')
    share book
@endsection

@section('content')
    <div class="allforms">
        <h1>share a book <i class="fa-solid fa-arrow-up-right-from-square"></i></h1>
        <form class="container-fluid col-lg-7" method="POST" action="{{ route('seminar.store') }}"
            enctype="multipart/form-data">
            @csrf




            <div class="repeater">
                <div data-repeater-list="dayslist">

                    <input type="button" class="btn btn-success mt-2 mb-2" value="add day with related periods" data-repeater-create>
                    <div class="form-group col-md-12" data-repeater-item>
                        <label for="inputEmail4">days</label>
                        <input type="text" name="days"
                            class="form-control @error('days') is-invalid @enderror" id="inputEmail4">
                        @error('days')
                            <span class="invalid-feedbackk">
                                {{ $message }}
                            </span>
                        @enderror
                        <label for="inputEmail4">periods</label>
                        <input type="text" name="period" class="form-control @error('period') is-invalid @enderror"
                            id="inputEmail4">
                        @error('period')
                            <span class="invalid-feedbackk">
                                {{ $message }}
                            </span>
                        @enderror
                        <label for="inputEmail4" class="mt-3">period topic</label>
                        <input type="text" name="period_topic" class="form-control @error('period_topic') is-invalid @enderror"
                            id="inputEmail4">
                        @error('period_topic')
                            <span class="invalid-feedbackk">
                                {{ $message }}
                            </span>
                        @enderror
                        <label for="inputEmail4" class="mt-3">period description</label>
                        <input type="text" name="period_des" class="form-control @error('period_des') is-invalid @enderror"
                            id="inputEmail4">
                        @error('period_des')
                            <span class="invalid-feedbackk">
                                {{ $message }}
                            </span>
                        @enderror
                        <label class="mt-3">speaker</label>
                        <select name="speaker_id" class="@error('speaker_id') is-invalid @enderror form-control"
                            value="{{ old('speaker_id') }}"id="exampleFormControlSelect1">
                            <option selected disabled>chosse</option>
                            <option value="online">online</option>
                            <option value="offline">offline</option>

                        </select>
                        <input type="button" class="btn btn-danger mt-3" value="delete" data-repeater-delete>

                    </div>

                </div>
            </div>




            <div class="submit">
                <button type="submit" class="creative">
                    <span class="shadoww"></span>
                    <span class="edgee"></span>
                    <span class="frontt text submit">share</span>
                </button>
            </div>

        </form>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/repeat/jquery.repeater.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.repeater').repeater({
                // (Required if there is a nested repeater)
                // Specify the configuration of the nested repeaters.
                // Nested configuration follows the same format as the base configuration,
                // supporting options "defaultValues", "show", "hide", etc.
                // Nested repeaters additionally require a "selector" field.
                repeaters: [{
                    // (Required)
                    // Specify the jQuery selector for this nested repeater
                    selector: '.inner-repeater'
                }]
            });
        });
    </script>
@endsection
