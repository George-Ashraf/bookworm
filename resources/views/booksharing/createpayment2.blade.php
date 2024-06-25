@extends('layouts.master2')
@section('title')
   payment
@endsection

@section('content')

    <div class="buy">
        <div class="container px-4 py-5 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="col-5">
                    <h4 class="heading">Sharing book pay</h4>
                </div>
                <div class="col-7">
                    <div class="row text-right">
                        <div class="col-4">
                            <h6 class="mt-2">Format</h6>
                        </div>
                        <div class="col-4">
                            <h6 class="mt-2">Quantity</h6>
                        </div>
                        <div class="col-4">
                            <h6 class="mt-2">Price</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center border-top">
                <div class="col-5">
                    <div class="row d-flex">
                        <div class="book">
                            <img src="{{ asset('attachments').'/' .'booksharing_two'. $booksharing_two->id.'/' . $booksharing_two->book_cover }}" class="book-img">
                        </div>
                        <div class="my-auto flex-column d-flex pad-left">
                            <h6 class="mob-text">{{$booksharing_two->book_name}}</h6>
                            <p class="mob-text">{{$booksharing_two->author}}</p>
                        </div>
                    </div>
                </div>
                <div class="my-auto col-7">
                    <div class="row text-right">
                        <div class="col-4">
                            <p class="mob-text">{{$booksharing_two->format}}</p>
                        </div>
                        <div class="col-4">
                            <div class="row d-flex justify-content-end px-3">
                                <p class="mb-0" id="cnt1">----</p>

                            </div>
                        </div>
                        <div class="col-4">
                            <h6 class="mob-text">---</h6>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center">
                <form action="{{ route('sharepaymenttwo.store') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $booksharing_two->id }}" name="booksharing_two_id">
                    <input type="hidden" value="{{ $booksharing_two->BS_section_id }}" name="BS_section_id">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="row px-2">
                                        <div class="form-group col-md-6">
                                            <label class="form-control-label">Name on Card</label>
                                            <input type="text" name="card_holder_name"
                                                class="@error('card_holder_name') is-invalid @enderror form-control"
                                                value="{{  $booksharing_two->name }}">

                                            @error('card_holder_name')
                                                <span class="invalid-feedbackk">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-control-label">Card Number</label>
                                            <input type="text"
                                                class="@error('card_number') is-invalid @enderror form-control"
                                                name="card_number" id="cr_no" placeholder="0000-0000-0000-0000"
                                                minlength="19" maxlength="19" value="{{ old('card_number') }}">
                                            @error('card_number')
                                                <span class="invalid-feedbackk">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row px-2">
                                        <div class="form-group col-md-6">
                                            <label class="form-control-label">Expiration Date</label>
                                            <input type="month" name="exp_date" placeholder="MM/YYYY" value="{{old('exp_date')}}" size="7"  minlength="7" maxlength="7">
                                            @error('exp_date')
                                            <span class="invalid-feedbackk">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-control-label">CVV</label>
                                            <input type="text"
                                                class="@error('cvv') is-invalid @enderror form-control placeicon"
                                                name="cvv" placeholder="&#9679;&#9679;&#9679;" minlength="3"
                                                maxlength="3" value="{{ old('cvv') }}">
                                            @error('cvv')
                                                <span class="invalid-feedbackk">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <div class="row d-flex justify-content-between px-4">
                                        <p class="mb-1 text-left">Subtotal</p>
                                        <h6 class="mb-1 text-right">-----</h6>
                                    </div>
                                    <div class="row d-flex justify-content-between px-4">
                                        <p class="mb-1 text-left">book sharing service</p>
                                        <h6 class="mb-1 text-right">100 LE</h6>
                                    </div>
                                    <div class="row d-flex justify-content-between px-4" id="tax">
                                        <p class="mb-1 text-left">Total (tax included)</p>
                                        <h6 class="mb-1 text-right">100 LE</h6>
                                    </div>
                                    <button class="btn-block btn-blue">
                                        <span>
                                            <span id="checkout">Checkout</span>
                                            <span id="check-amt">100 LE</span>
                                        </span>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @if ($booksharing_two->format == 'hard copy')
            <form action="{{ route('sharepaymenttwocash.store') }}" method="POST"
                class="d-flex justify-content-center">
                @csrf
                <input type="hidden" value="{{ $booksharing_two->id }}" name="booksharing_two_id">
                <input type="hidden" value="{{ $booksharing_two->BS_section_id }}" name="BS_section_id">

                <button class="btn-block btn-blue col-lg-4">
                    <span>
                        <span id="checkout"><i class="fa-solid fa-money-bills mr-3"></i>Cash</span>
                        <span id="check-amt">100 LE</span>


                    </span>
                </button>
            </form>
        @endif
        </div>
    </div>
@endsection











@section('js')
    <script>
        $(document).ready(function() {

            //For Card Number formatted input
            var cardNum = document.getElementById('cr_no');
            cardNum.onkeyup = function(e) {
                if (this.value == this.lastValue) return;
                var caretPosition = this.selectionStart;
                var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
                var parts = [];

                for (var i = 0, len = sanitizedValue.length; i < len; i += 4) {
                    parts.push(sanitizedValue.substring(i, i + 4));
                }

                for (var i = caretPosition - 1; i >= 0; i--) {
                    var c = this.value[i];
                    if (c < '0' || c > '9') {
                        caretPosition--;
                    }
                }
                caretPosition += Math.floor(caretPosition / 4);

                this.value = this.lastValue = parts.join('-');
                this.selectionStart = this.selectionEnd = caretPosition;
            }

            //For Date formatted input
            var expDate = document.getElementById('exp');
            expDate.onkeyup = function(e) {
                if (this.value == this.lastValue) return;
                var caretPosition = this.selectionStart;
                var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
                var parts = [];

                for (var i = 0, len = sanitizedValue.length; i < len; i += 2) {
                    parts.push(sanitizedValue.substring(i, i + 2));
                }

                for (var i = caretPosition - 1; i >= 0; i--) {
                    var c = this.value[i];
                    if (c < '0' || c > '9') {
                        caretPosition--;
                    }
                }
                caretPosition += Math.floor(caretPosition / 2);

                this.value = this.lastValue = parts.join('/');
                this.selectionStart = this.selectionEnd = caretPosition;
            }



        })
    </script>


@endsection
