@extends('layouts.master2')
@section('title')
    add seminar
@endsection

@section('content')
    <div class="allforms">
        <h1>add seminar <i class="fa-solid fa-arrow-up-right-from-square"></i></h1>
        <form class="container-fluid col-lg-7" method="POST" action="{{ route('seminar.store') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">seminar_name</label>
                    <input type="text" name="seminar_name" value="{{ Auth()->user()->seminar_name }}"
                        class="@error('seminar_name') is-invalid @enderror form-control" value="{{ old('seminar_name') }}">


                    @error('seminar_name')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleFormControlSelect1">type</label>
                    <select name="type" class="@error('type') is-invalid @enderror form-control"
                        value="{{ old('type') }}"id="exampleFormControlSelect1">
                        <option selected disabled>chosse</option>
                        <option value="online">online</option>
                        <option value="offline">offline</option>

                    </select>
                </div>
                @error('type')
                    <span class="invalid-feedbackk">
                        {{ $message }}
                    </span>
                @enderror
            </div>




            <div class="form-group">
                <label for="validationDefault05">seminar topic</label>
                <input type="text" name="topic" class="@error('topic') is-invalid @enderror form-control"
                    value="{{ old('topic') }}">

                @error('topic')
                    <span class="invalid-feedbackk">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="validationDefault05">start_time</label>
                    <input type="datetime-local" name="start_time"
                        class="@error('start_time') is-invalid @enderror form-control" value="{{ old('start_time') }}">

                    @error('start_time')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="validationDefault05">duration</label>
                    <input type="number" name="duration" class="@error('duration') is-invalid @enderror form-control"
                        value="{{ old('duration') }}">

                    @error('duration')
                        <span class="invalid-feedbackk">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="validationDefault05">address</label>
                <input type="text" name="address" class="@error('address') is-invalid @enderror form-control"
                    value="{{ old('address') }}">

                @error('address')
                    <span class="invalid-feedbackk">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputEmail4">seminar description</label>

             <textarea type="text" name="seminar_des" value="{{ Auth()->user()->seminar_des }}" class="@error('seminar_des') is-invalid @enderror form-control" rows="3">
                {{ old('seminar_des') }}
                </textarea>
                @error('seminar_des')
                    <span class="invalid-feedbackk">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="submit">
                <button type="submit" class="creative">
                    <span class="shadoww"></span>
                    <span class="edgee"></span>
                    <span class="frontt text submit">add </span>
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
