@extends('layouts.master2')
@section('title')
    register
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login_register.css') }}">
@endsection
@section('content')
    <div class="wrapper">
        <div class="form-box">

            <div class="register-container" id="Register">
                <form method="POST" action="{{ route('bookstore.store') }}">
                    @csrf
                    <div class="top">
                        <span>already Have an account ? <a href="{{ route('selection') }}">login</a></span>
                        <div class="head">Sign Up as book store</div>
                    </div>

                    <div class="input-box">
                        <input id="name" type="text"class="input-field @error('book_store_name') is-invalid @enderror" name="book_store_name"value="{{ old('book_store_name') }}" placeholder="bookstore name">
                        <i class="fa-solid fa-shop"></i>
                        @error('book_store_name')
                            <span class="invalid-feedbackk">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="input-box">
                        <input id="name" type="text" class="input-field @error('phone') is-invalid @enderror"
                            name="phone" value="{{ old('phone') }}" autofocus placeholder="phone">
                        <i class="fa-solid fa-phone"></i>
                        @error('phone')
                            <span class="invalid-feedbackk">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="input-box">
                        <input id="name" type="text" class="input-field @error('address') is-invalid @enderror"
                            name="address" value="{{ old('address') }}" placeholder="address">
                        <i class="fa-solid fa-location-dot"></i>
                        @error('address')
                            <span class="invalid-feedbackk">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <input id="name" type="text" class="input-field @error('owner') is-invalid @enderror"
                            name="owner" value="{{ old('owner') }}" placeholder="owner">
                            <i class="fa-solid fa-user-tie"></i>
                        @error('owner')
                            <span class="invalid-feedbackk">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <input class="@error('email') is-invalid @enderror input-field "name="email"
                            value="{{ old('email') }}" placeholder="email">
                        <i class="fa-solid fa-envelope"></i>
                        @error('email')
                            <span class="invalid-feedbackk">
                                {{ $message }}

                            </span>
                        @enderror
                    </div>

                    <div class="input-box">
                        <input id="password" type="password" class="input-field @error('password') is-invalid @enderror"
                            name="password" value="{{ old('password') }}" autocomplete="new-password"
                            placeholder="password">
                        <i class="fa-solid fa-lock"></i>
                        @error('password')
                            <span class="invalid-feedbackk">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="input-box">
                        <input id="password-confirm" type="password"
                            class="@error('confirm_password') is-invalid @enderror input-field" name="confirm_password"
                            value="{{ old('confirm_password') }}" autocomplete="new-password"
                            placeholder="confirm password">
                        <i class="fa-solid fa-lock"></i>
                        @error('confirm_password')
                            <span class="invalid-feedbackk">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <input type="text"
                        class="@error('card_number') is-invalid @enderror input-field"
                        name="card_number" id="cr_no" placeholder="card number 0000-0000-0000-0000"
                        minlength="19" maxlength="19" value="{{ old('card_number') }}"
                            placeholder="card number">
                        <i class="fa-regular fa-credit-card"></i>
                        @error('card_number')
                            <span class="invalid-feedbackk">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <input type="text"
                        class="@error('cvv') is-invalid @enderror input-field placeicon"
                        name="cvv"minlength="3"
                        maxlength="3" value="{{ old('cvv') }}"
                            placeholder="CVV">
                        <i class="fa-solid fa-credit-card"></i>
                        @error('cvv')
                            <span class="invalid-feedbackk">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <input type="month" name="exp_date"
                        value="{{ old('exp_date') }}" size="7" minlength="7" maxlength="7"
                            placeholder="expire date MM/YYYY" class="@error('exp_date') is-invalid @enderror input-field placeicon">
                        <i class="fa-solid fa-calendar-days"></i>
                        @error('exp_date')
                            <span class="invalid-feedbackk">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <input type="submit" class="submit" value="Register">
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
