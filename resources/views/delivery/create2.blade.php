@extends('layouts.master2')
@section('title')
    make delivery
@endsection

@section('content')
    <div class="allforms">
        <h1>make delivery <i class="fa-solid fa-truck"></i></h1>
        @if ($booksharingsection->payment_one == 'done')

            <form class="container-fluid col-lg-7" method="POST" action="{{ route('delivery.store2') }}"
                enctype="multipart/form-data">
                @csrf



                <div class="form-row">
                    <input type="hidden" value="{{ $booksharing_two->id }}" name="booksharing_two_id">

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
                            <option value="{{ $booksharing_two->section->id }}">
                                {{ $booksharing_two->section->section_name }}
                            </option>
                        </select>
                        @error('booksharing_section_id')
                            <span class="invalid-feedbackk">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                @if ($booksharing_two->section->format_one == 'soft copy' && $booksharing_two->section->format_two == 'hard copy')
                    <div class="form-row">

                        <div class="form-group  col-md-6">
                            <label for="exampleFormControlSelect1">from_booksharing_two</label>
                            <select type="text" name="from_booksharing_two"
                                class="@error('from_booksharing_two') is-invalid @enderror form-control">
                                <option value="{{ $booksharing_two->id }}">{{ $booksharing_two->name }}</option>
                            </select>
                            @error('from_booksharing_two')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group  col-md-6">
                            <label for="exampleFormControlSelect1">to_booksharing_one</label>
                            <select type="text"
                                name="to_booksharing_one"class="@error('to_booksharing_one') is-invalid @enderror form-control">
                                @foreach ($booksharing_one as $booksharing_onee)
                                    <option value="{{ $booksharing_onee->id }}">{{ $booksharing_onee->name }}</option>
                                @endforeach
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
                            <label for="inputEmail4">street</label>
                            <input type="text" name="street" class="@error('street') is-invalid @enderror form-control"
                                value="{{ $booksharing_two->reader->street }}">

                            @error('street')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">city</label>
                            <input name="city" class="@error('city') is-invalid @enderror form-control"
                                value="{{ $booksharing_two->reader->city }}">

                            @error('city')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">phone</label>
                            <input type="text" name="phone" class="@error('phone') is-invalid @enderror form-control"
                                value="{{ $booksharing_two->reader->phone }}">


                            @error('phone')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">street1</label>
                            <input type="text" name="street1" class="@error('street1') is-invalid @enderror form-control"
                                value="{{ $booksharingsection->user1->street }}">

                            @error('street1')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">city1</label>
                            <input name="city1" class="@error('city1') is-invalid @enderror form-control"
                                value="{{ $booksharingsection->user1->city }}">

                            @error('city1')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">phone1</label>
                            <input type="text" name="phone1" class="@error('phone1') is-invalid @enderror form-control"
                                value="{{ $booksharingsection->user1->phone }}">


                            @error('phone1')
                                <span class="invalid-feedbackk">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    @elseif ($booksharing_two->section->format_one == 'hard copy' && $booksharing_two->section->format_two == 'hard copy')
                    <div class="alert alert-warning">
                      <p>hard to hard delivery assign to one delivery man from booksharing one delivery table</p>
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
                <p>{{ $booksharingsection->user1->name }} not pay </p>
            </div>
        @endif
    </div>
@endsection
