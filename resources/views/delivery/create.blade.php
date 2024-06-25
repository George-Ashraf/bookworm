@extends('layouts.master2')
@section('title')
    make delivery
@endsection

@section('content')
    <div class="allforms">
        <h1>make delivery <i class="fa-solid fa-truck"></i></h1>
        @if ($booksharingsection->payment_two == 'done')
            <form class="container-fluid col-lg-7" method="POST" action="{{ route('delivery.store') }}"
                enctype="multipart/form-data">
                @csrf


                <div class="form-row">
                    <input type="hidden" value="{{ $booksharing_one->id }}" name="booksharing_one_id">
                    <input type="hidden" value="{{ $booksharingsection->id }}" name="booksharingsection_id">
                    @foreach ($booksharing_two as $id)
                        <input type="hidden" value="{{ $id->id }}" name="booksharing_two_id">
                    @endforeach
                    <div class="form-group  col-md-6">
                        <label for="exampleFormControlSelect1">delivery man</label>
                        <select name="delivery_man_id" class="@error('delivery_man_id') is-invalid @enderror form-control">
                            <option selected disabled>chosse</option>
                            @foreach ($mans as $man)
                                <option value="{{ $man->id }}">{{ $man->name }}</option>
                            @endforeach
                        </select>
                        @error('delivery_man_id')
                            <span class="invalid-feedbackk">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">booksharing_section</label>
                        <select type="text"
                            name="booksharing_section_id"class="@error('booksharing_section_id') is-invalid @enderror form-control">
                            <option value="{{ $booksharing_one->section->id }}">
                                {{ $booksharing_one->section->section_name }}
                            </option>
                        </select>
                        @error('booksharing_section_id')
                            <span class="invalid-feedbackk">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                @if ($booksharing_one->section->format_one == 'hard copy' && $booksharing_one->section->format_two == 'hard copy')
                    <div class="form-row">

                        <div class="form-group  col-md-6">
                            <label for="exampleFormControlSelect1">from_booksharing_one</label>
                            <select type="text" name="from_booksharing_one"
                                class="@error('from_booksharing_one') is-invalid @enderror form-control"
                                value="{{ $booksharing_one->name }}">
                                <option value="{{ $booksharing_one->id }}">{{ $booksharing_one->name }}</option>
                            </select>
                            @error('from_booksharing_one')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group  col-md-6">
                            <label for="exampleFormControlSelect1">to_booksharing_two</label>
                            <select type="text"
                                name="to_booksharing_two"class="@error('to_booksharing_two') is-invalid @enderror form-control">
                                @foreach ($booksharing_two as $booksharing_twoo)
                                    <option value="{{ $booksharing_twoo->id }}">{{ $booksharing_twoo->name }}</option>
                                @endforeach
                            </select>
                            @error('to_booksharing_two')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">street</label>
                            <input type="text" name="street" class="@error('street') is-invalid @enderror form-control"
                                value="{{ $booksharing_one->reader->street }}">


                            @error('street')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">city</label>
                            <input name="city" class="@error('city') is-invalid @enderror form-control"
                                value="{{ $booksharing_one->reader->city }}">

                            @error('city')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">phone</label>
                            <input type="text" name="phone" class="@error('phone') is-invalid @enderror form-control"
                                value="{{ $booksharing_one->reader->phone }}">


                            @error('phone')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group  col-md-6">
                            <label for="exampleFormControlSelect1">from_booksharing_two</label>
                            <select type="text"
                                name="from_booksharing_two"class="@error('from_booksharing_two') is-invalid @enderror form-control">
                                @foreach ($booksharing_two as $booksharing_two)
                                    <option value="{{ $booksharing_two->id }}">{{ $booksharing_two->name }}</option>
                                @endforeach
                            </select>
                            @error('from_booksharing_two')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group  col-md-6">
                            <label for="exampleFormControlSelect1">to_booksharing_one</label>
                            <select type="text"name="to_booksharing_one"
                                class="@error('to_booksharing_one') is-invalid @enderror form-control">
                                <option value="{{ $booksharing_one->id }}">{{ $booksharing_one->name }}</option>

                            </select>
                            @error('to_booksharing_one')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">street2</label>
                            <input type="text" name="street2" class="@error('street2') is-invalid @enderror form-control"
                                value="{{ $booksharingsection->user2->street }}">

                            @error('street2')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">city2</label>
                            <input name="city2" class="@error('city2') is-invalid @enderror form-control"
                                value="{{ $booksharingsection->user2->city }}">

                            @error('city2')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">phone2</label>
                            <input type="text" name="phone2" class="@error('phone2') is-invalid @enderror form-control"
                                value="{{ $booksharingsection->user2->phone }}">


                            @error('phone2')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                @elseif ($booksharing_one->section->format_one == 'hard copy' && $booksharing_one->section->format_two == 'soft copy')
                    <div class="form-row">

                        <div class="form-group  col-md-6">
                            <label for="exampleFormControlSelect1">from_booksharing_one</label>
                            <select type="text" name="from_booksharing_one"
                                class="@error('from_booksharing_one') is-invalid @enderror form-control"
                                value="{{ $booksharing_one->name }}">
                                <option value="{{ $booksharing_one->id }}">{{ $booksharing_one->name }}</option>
                            </select>
                            @error('from_booksharing_one')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group  col-md-6">
                            <label for="exampleFormControlSelect1">to_booksharing_two</label>
                            <select type="text"
                                name="to_booksharing_two"class="@error('to_booksharing_two') is-invalid @enderror form-control">
                                @foreach ($booksharing_two as $booksharing_twoo)
                                    <option value="{{ $booksharing_twoo->id }}">{{ $booksharing_twoo->name }}</option>
                                @endforeach
                            </select>
                            @error('to_booksharing_two')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">street</label>
                            <input type="text" name="street"
                                class="@error('street') is-invalid @enderror form-control"
                                value="{{ $booksharing_one->reader->street }}">


                            @error('street')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">city</label>
                            <input name="city" class="@error('city') is-invalid @enderror form-control"
                                value="{{ $booksharing_one->reader->city }}">

                            @error('city')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">phone</label>
                            <input type="text" name="phone"
                                class="@error('phone') is-invalid @enderror form-control"
                                value="{{ $booksharing_one->reader->phone }}">


                            @error('phone')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">street2</label>
                            <input type="text" name="street2"
                                class="@error('street2') is-invalid @enderror form-control"
                                value="{{ $booksharingsection->user2->street }}">

                            @error('street2')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">city2</label>
                            <input name="city2" class="@error('city2') is-invalid @enderror form-control"
                                value="{{ $booksharingsection->user2->city }}">

                            @error('city2')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">phone2</label>
                            <input type="text" name="phone2"
                                class="@error('phone2') is-invalid @enderror form-control"
                                value="{{ $booksharingsection->user2->phone }}">


                            @error('phone2')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                @endif


                <button type="submit" class="creative">
                    <span class="shadoww"></span>
                    <span class="edgee"></span>
                    <span class="frontt text submit">deliver</span>
                </button>
            </form>
        @else
            <div class="alert alert-warning notpay">
                <p> {{$booksharingsection->user2->name}} not pay </p>
            </div>
        @endif

    </div>
@endsection
