@extends('layouts.master')
@section('title')
    seminar
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/seminar.css') }}">
@endsection



@section('content')
    <div class="schedualbox">

        <h1 class="heading">Seminar Scheduals</h1>
        @if (Session::has('done'))
        <div class="alert text-center alert-success col-lg-12 mt-2">
            <p>{{ session::get('done') }}</p>
        </div>
    @endif
        @if (auth('admin')->check())
            <button class="makesection creative" type="button" data-toggle="modal" data-target="#modelsection">
                <span class="shadoww"></span>
                <span class="edgee"></span>
                <span class="frontt text">add a day </span>
            </button>
            @elseif (auth('web')->check() && $meet->type=='offline')
            <a href="{{route('seminar.createpayment',$meet->id)}}">
            <button class="makesection creative">
                <span class="shadoww"></span>
                <span class="edgee"></span>
                <span class="frontt text">book a ticket </span>
            </button>
        </a>
        @endif

        <div class="modal fade" id="modelsection" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('day.store') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add a day</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="repeater">
                            <div class="modal-body" data-repeater-list="days_list">
                                <input type="button" class="btn btn-success mt-2 mb-2" value="add more day"
                                    data-repeater-create>
                                <input type="hidden" name="seminar_id" value="{{ $meet->id }}">

                                <div class="form-group" data-repeater-item>
                                    <label for="recipient-name" class="col-form-label">date of day</label>

                                    <input type="date" class="@error('day') is-invalid @enderror form-control"
                                        name="day">

                                    @error('day')
                                        <span class="invalid-feedbackk">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <input type="button" class="btn btn-danger mt-3" value="delete day"
                                        data-repeater-delete>

                                </div>

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

        <div class="accordion-container">
            @forelse ($days as $day)
                <div class="accordion">
                    <div class="accordion-heading">
                        <h3>Day {{ $loop->index + 1 }} </h3>
                        <h4>
                            {{ $day->day }}

                            @if (auth('admin')->check())
                                <i class="fa-solid fa-highlighter" data-toggle="modal" data-target="#update{{ $day->id }}"></i>
                              <a href="{{route('day.destroy',$day->id)}}"><i class="fa-regular fa-trash-can"></i></a>
                            @endif
                            <div class="modal fade" id="update{{ $day->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('day.update', $day->id) }}">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">edit a day</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="repeater">
                                                <div class="modal-body">



                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">date of
                                                            day</label>

                                                        <input type="date"
                                                            class="@error('day') is-invalid @enderror form-control"
                                                            name="day" value="{{ $day->day }}">

                                                        @error('day')
                                                            <span class="invalid-feedbackk">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror


                                                    </div>

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
                        </h4>
                        <i class="fas fa-angle-down"></i>
                    </div>
                    @if (auth('admin')->check())
                        <button class="makesection creative mt-4" type="button" data-toggle="modal"
                            data-target="#period{{ $day->id }}">
                            <span class="shadoww"></span>
                            <span class="edgee"></span>
                            <span class="frontt text">add period </span>
                        </button>
                    @endif

                    <div class="modal fade" id="period{{ $day->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('period.store') }}">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add a period</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <input type="hidden" name="day_id" value="{{ $day->id }}">

                                    <div class="repeater">
                                        <div class="modal-body" data-repeater-list="periods_list">
                                            <input type="button" class="btn btn-success mt-2 mb-2"
                                                value="add more period" data-repeater-create>
                                            <div data-repeater-item>

                                                <div class="form-row">
                                                    <div class="form-group col-lg-6">
                                                        <label for="recipient-name" class="col-form-label">from</label>

                                                        <input type="time"
                                                            class="@error('period1') is-invalid @enderror form-control"
                                                            name="period1">

                                                        @error('period1')
                                                            <span class="invalid-feedbackk">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror

                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="recipient-name" class="col-form-label">to</label>

                                                        <input type="time"
                                                            class="@error('period2') is-invalid @enderror form-control"
                                                            name="period2">

                                                        @error('period2')
                                                            <span class="invalid-feedbackk">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror

                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <label for="recipient-name"
                                                        class="col-form-label">period_topic</label>

                                                    <input type="text"
                                                        class="@error('period_topic') is-invalid @enderror form-control"
                                                        name="period_topic">

                                                    @error('period_topic')
                                                        <span class="invalid-feedbackk">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror

                                                </div>
                                                <div class="form-group">
                                                    <label for="recipient-name"
                                                        class="col-form-label">period_description</label>

                                                    <input type="text"
                                                        class="@error('period_des') is-invalid @enderror form-control"
                                                        name="period_des">

                                                    @error('period_des')
                                                        <span class="invalid-feedbackk">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror

                                                </div>
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">speaker</label>

                                                    <select
                                                        type="text"class="@error('speaker_id') is-invalid @enderror form-control"
                                                        name="speaker_id">
                                                        <option selected disabled>choose</option>

                                                        @foreach ($speaker as $talk)
                                                            <option value="{{ $talk->id }}">{{ $talk->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @error('speaker_id')
                                                        <span class="invalid-feedbackk">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                    <input type="button" class="btn btn-danger mt-3"
                                                        value="delete period" data-repeater-delete>
                                                </div>
                                            </div>

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
                    @forelse ($day->periods as $period)
                        <div class="accordion-content">
                            <div class="meet">
                                <i class="fa-solid fa-clock"></i>{{ $period->period1 }} -{{ $period->period2 }}<span>{{ $period->period_topic }} @if(auth('admin')->check()) <i class="fa-solid fa-pen-fancy" data-toggle="modal" data-target="#updateperiod{{ $period->id }}"></i> <a href="{{route('period.destroy',$period->id)}}"><i class="fa-regular fa-trash-can"></i></a> @endif</span>
                                <p class="speaker">{{ $period->speaker->name }}</p>
                                <p class="content">{{ $period->period_des }}</p>
                            </div>


                        </div>
                        <div class="modal fade" id="updateperiod{{ $period->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('period.update',$period->id) }}">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">update a period</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>



                                            <div class="modal-body" >



                                                    <div class="form-row">
                                                        <div class="form-group col-lg-6">
                                                            <label for="recipient-name" class="col-form-label">from</label>

                                                            <input type="time"
                                                                class="@error('period1') is-invalid @enderror form-control"
                                                                name="period1" value="{{$period->period1}}">

                                                            @error('period1')
                                                                <span class="invalid-feedbackk">
                                                                    {{ $message }}
                                                                </span>
                                                            @enderror

                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <label for="recipient-name" class="col-form-label">to</label>

                                                            <input type="time"
                                                                class="@error('period2') is-invalid @enderror form-control"
                                                                name="period2" value="{{$period->period2}}">

                                                            @error('period2')
                                                                <span class="invalid-feedbackk">
                                                                    {{ $message }}
                                                                </span>
                                                            @enderror

                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name"
                                                            class="col-form-label">period_topic</label>

                                                        <input type="text"
                                                            class="@error('period_topic') is-invalid @enderror form-control"
                                                            name="period_topic" value="{{$period->period_topic}}">

                                                        @error('period_topic')
                                                            <span class="invalid-feedbackk">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name"
                                                            class="col-form-label">period_description</label>

                                                        <input type="text"
                                                            class="@error('period_des') is-invalid @enderror form-control"
                                                            name="period_des" value="{{$period->period_des}}">

                                                        @error('period_des')
                                                            <span class="invalid-feedbackk">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">speaker</label>

                                                        <select
                                                            type="text"class="@error('speaker_id') is-invalid @enderror form-control"
                                                            name="speaker_id">
                                                            <option selected disabled>choose</option>

                                                            @foreach ($speaker as $talk)
                                                                <option value="{{ $talk->id }}" {{$talk->id == $period->speaker_id ? 'selected' : ""}}>{{ $talk->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        @error('speaker_id')
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

                    @empty
                        <div class="alert alert-warning">
                            no period yet
                        </div>

                    @endforelse


                </div>
            @empty
                <div class="alert alert-warning">
                    no days for this seminar
                </div>
            @endforelse




        </div>




    </div>

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
            let accordions = document.querySelectorAll('.accordion-container .accordion');

            accordions.forEach(acco => {
                acco.onclick = () => {
                    accordions.forEach(subAcco => {
                        subAcco.classList.remove('active')
                    });
                    acco.classList.add('active');
                }
            })
        </script>
    @endsection
@endsection
