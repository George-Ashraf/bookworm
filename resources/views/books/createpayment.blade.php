@extends('layouts.master2')
@section('title')
    payment
@endsection

@section('content')
    <div class="buy">
        <div class="container px-4 py-5 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="col-5">
                    <h4 class="heading">purchase book</h4>
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
                            <img src="{{asset('attachments') . '/' .'book_panel'.$bookinfo->id.'/' .$bookinfo->book_cover }}"
                                class="book-img">
                        </div>
                        <div class="my-auto flex-column d-flex pad-left">

                            <h6 class="mob-text">{{ $bookinfo->book_name }}</h6>
                            <p class="mob-text">{{ $bookinfo->author }}</p>
                        </div>
                    </div>
                </div>
                <div class="my-auto col-7">
                    <div class="row text-right">
                        <div class="col-4">
                            @if ($bookinfo->format == 'hard copy & soft copy')
                                @if ($bookinfo->choose == 'hard')
                                    <p class="mob-text">hard copy</p>
                                @else
                                    <p class="mob-text">soft copy</p>
                                @endif
                            @else
                                <p class="mob-text">{{ $bookinfo->format }}</p>
                            @endif
                        </div>
                        <div class="col-4">
                            <div class="row d-flex justify-content-end px-3">
                                <p class="mb-0" id="cnt1">----</p>

                            </div>
                        </div>
                        <div class="col-4">
                            @if ($bookinfo->choose == 'hard')
                                <h6 class="mob-text">{{ $bookinfo->pricehard }}</h6>
                            @elseif ($bookinfo->choose == 'soft')
                                <h6 class="mob-text">{{ $bookinfo->pricesoft }}</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center">
                <form action="{{ route('paymentbook.store') }}" method="POST">
                    <input type="hidden" name="book_id" value="{{ $bookinfo->id }}">

                    @csrf

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="row px-2">
                                        <div class="form-group col-md-6">
                                            <label class="form-control-label">Name on Card</label>
                                            <input type="text" name="card_holder_name"
                                                class="@error('card_holder_name') is-invalid @enderror form-control"
                                                value="{{ Auth()->user()->name }}">

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
                                            <input type="month" name="exp_date" placeholder="MM/YYYY"
                                                value="{{ old('exp_date') }}" size="7" minlength="7" maxlength="7">
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
                                        @if ($bookinfo->choose == 'hard')
                                            <h6 class="mob-text">{{ $bookinfo->pricehard }}</h6>
                                        @elseif ($bookinfo->choose == 'soft')
                                            <h6 class="mob-text">{{ $bookinfo->pricesoft }}</h6>
                                        @endif
                                    </div>
                                    <div class="row d-flex justify-content-between px-4">

                                        @if ($bookinfo->choose == 'hard')
                                            <p class="mb-1 text-left">delivery</p>
                                            <h6 class="mb-1 text-right">50 LE</h6>
                                        @endif
                                    </div>
                                    <div class="row d-flex justify-content-between px-4" id="tax">
                                        <p class="mb-1 text-left">Total (tax included)</p>
                                        @if ($bookinfo->choose == 'hard')
                                            <h6 class="mb-1 text-right">{{ $bookinfo->pricehard + 50 }}</h6>
                                        @elseif ($bookinfo->choose == 'soft')
                                            <h6 class="mb-1 text-right">{{ $bookinfo->pricesoft  }}</h6>
                                        @endif
                                    </div>
                                    <button class="btn-block btn-blue">
                                        <span>
                                            <span id="checkout">Checkout</span>
                                            @if ($bookinfo->choose == 'hard')
                                                <span id="check-amt">{{ $bookinfo->pricehard + 50 }}</span>
                                                <input type="hidden" name="pricehard"
                                                    value="{{ $bookinfo->pricehard + 50 }}">
                                            @elseif ($bookinfo->choose == 'soft')
                                                <span id="check-amt">{{ $bookinfo->pricesoft }}</span>
                                                <input type="hidden" name="pricesoft"
                                                    value="{{ $bookinfo->pricesoft }}">
                                            @endif
                                        </span>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            @if ($bookinfo->choose == 'hard')

                <form action="{{route('paycashbook.store')}}" method="POST"  class="d-flex justify-content-center">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $bookinfo->id }}">

                    <button class="btn-block btn-blue col-lg-4">
                        <span>
                            <span id="checkout"><i class="fa-solid fa-money-bills mr-3"></i>Cash</span>
                            @if ($bookinfo->choose == 'hard')
                                <span id="check-amt">{{ $bookinfo->pricehard + 50 }}</span>
                                <input type="hidden" name="pricehard"
                                    value="{{ $bookinfo->pricehard + 50 }}">

                            @endif
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
        $(document).ready(function() {

            $('.radio-group .radio').click(function() {
                $('.radio').addClass('gray');
                $(this).removeClass('gray');
            });

            $('.plus-minus .plus').click(function() {
                var count = $(this).parent().prev().text();
                $(this).parent().prev().html(Number(count) + 1);
            });

            $('.plus-minus .minus').click(function() {
                var count = $(this).parent().prev().text();
                $(this).parent().prev().html(Number(count) - 1);
            });

        });
    </script>
@endsection
