@extends('layouts.master2')
@section('title')
    make delivery
@endsection

@section('content')
    <div class="allforms">
        <h1>make delivery <i class="fa-solid fa-truck"></i></h1>
        <form class="container-fluid col-lg-12 deliverybook" method="POST" action="{{ route('delivery.store3') }}"
            enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="bookpayment_id" value="{{ $purchasedbook->id }}">
            <input type="hidden" name="book_id" value="{{ $purchasedbook->book_id }}">


            <div class="form-group  col-md-9">
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




            <div class="form-group col-md-9">
                <label for="inputEmail4">street</label>
                <input type="text" name="street" class="@error('street') is-invalid @enderror form-control"
                    value="{{ $purchasedbook->user->street }}">


                @error('street')
                    <span class="invalid-feedbackk">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="form-group col-md-9">
                <label for="inputEmail4">city</label>
                <input name="city" class="@error('city') is-invalid @enderror form-control"
                    value="{{ $purchasedbook->user->city }}">

                @error('city')
                    <span class="invalid-feedbackk">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="form-group col-md-9">
                <label for="inputEmail4">phone</label>
                <input type="text" name="phone" class="@error('phone') is-invalid @enderror form-control"
                    value="{{ $purchasedbook->user->phone }}">


                @error('phone')
                    <span class="invalid-feedbackk">
                        {{ $message }}
                    </span>
                @enderror
            </div>





            <button type="submit" class="creative">
                <span class="shadoww"></span>
                <span class="edgee"></span>
                <span class="frontt text submit">deliver</span>
            </button>
        </form>
    </div>
@endsection
