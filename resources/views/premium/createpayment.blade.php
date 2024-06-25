@extends('layouts.master2')
@section('title')
   premium payment
@endsection

@section('content')
    <div class="buy">
        <div class="container px-4 py-5 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="col-5">
                    <h4 class="heading">premium</h4>
                </div>
                <div class="col-7">
                    <div class="row text-right">

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
                            <img src="{{ asset('assets/img/premium.png') }}"
                                class="book-img">
                        </div>

                    </div>
                </div>
                <div class="my-auto col-7">
                    <div class="row text-right">

                        <div class="col-4">
                            <h6 class="mob-text">50 LE</h6>


                        </div>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center">
                <form action="{{ route('premium.store') }}" method="POST">

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
                                                name="card_number" maxlength="19" id="cr_no" minlength="19"  placeholder="0000-0000-0000-0000"
                                                 value="{{ old('card_number') }}">
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

                                            <h6 class="mob-text">50 LE</h6>

                                    </div>

                                    <div class="row d-flex justify-content-between px-4" id="tax">
                                        <p class="mb-1 text-left">Total (tax included)</p>

                                            <h6 class="mb-1 text-right">50 LE</h6>

                                    <button class="btn-block btn-blue">
                                        <span>
                                            <span id="checkout">Checkout</span>

                                                <span id="check-amt">50 LE</span>


                                        </span>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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







