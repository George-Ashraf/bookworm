@extends('layouts.master')
@section('css')
@endsection
@section('title')
    profile
@endsection



@section('content')
    <section class="profilee container-fluid">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 ">
                        @if (auth('web')->check())
                            <img src="{{ asset('attachments') . '/' . 'user' . Auth::user()->id . '/' . Auth::user()->img }}"
                                alt="Profile" class="rounded-circle">
                        @elseif (auth('author')->check())
                            <img src="{{ asset('attachments') . '/' . 'author' . Auth::user()->id . '/' . Auth::user()->img }}"
                                alt="Profile" class="rounded-circle">
                        @elseif (auth('bookstore')->check())
                            <img src="{{ asset('attachments') . '/' . 'bookstore' . Auth::user()->id . '/' . Auth::user()->img }}"
                                alt="Profile" class="rounded-circle">
                        @elseif (auth('admin')->check())
                            <img src="{{ asset('attachments') . '/' . 'admin' . Auth::user()->id . '/' . Auth::user()->img }}"
                                alt="Profile" class="rounded-circle">
                        @endif
                        <h2>{{ Auth::user()->name }}</h2>
                        @if (auth('web')->check())
                            <h3>user</h3>
                        @elseif (auth('admin')->check())
                            <h3>admin</h3>
                        @elseif (auth('bookstore')->check())
                            <h3>bookstore</h3>
                        @elseif (auth('author')->check())
                            <h3>author</h3>
                        @endif
                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-toggle="pill"
                                    data-target="#profile-overview" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">overview</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-toggle="pill"
                                    data-target="#profile-edit" type="button" role="tab" aria-controls="pills-profile"
                                    aria-selected="false">Edit Profile</button>
                            </li>

                        </ul>

                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">


                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8"> {{ Auth::user()->name }}</div>
                                </div>
                                @if (auth('author')->check())
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">experience</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->experience }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">type of write</div>
                                        <div class="col-lg-9 col-md-8"> {{ Auth::user()->type_of_write }}</div>
                                    </div>
                                @endif

                                @if (auth('bookstore')->check())
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">bookstore name</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->bookstore_name }} </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->address }} </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->phone }} </div>
                                    </div>
                                @endif

                                @if (auth('web')->check())
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->city }}
                                            ,{{ Auth::user()->street }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->phone }} </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
                                </div>





                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                @if (auth('web')->check())
                                    <form method="POST" action="{{ route('user.update', Auth::user()->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img src="{{ asset('attachments') . '/' . 'user' . Auth::user()->id . '/' . Auth::user()->img }}"
                                                    alt="Profile">
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="img" type="file"
                                                        class="  @error('img') is-invalid @enderror">
                                                    @error('img')
                                                        <span class="invalid-feedbackk">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label"> name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text"
                                                    class="form-control  @error('name') is-invalid @enderror"
                                                    value="{{ Auth::user()->name }}">
                                                @error('name')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label"> email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="text"
                                                    class="form-control  @error('email') is-invalid @enderror"
                                                    value="{{ Auth::user()->email }}">
                                                @error('email')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label"> street</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="street" type="text"
                                                    class="form-control  @error('street') is-invalid @enderror"
                                                    value="{{ Auth::user()->street }}">
                                                @error('street')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label"> city</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="city" type="text"
                                                    class="form-control  @error('city') is-invalid @enderror"
                                                    value="{{ Auth::user()->city }}">
                                                @error('city')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label"> phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text"
                                                    class="form-control  @error('phone') is-invalid @enderror"
                                                    value="{{ Auth::user()->phone }}">
                                                @error('phone')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="text-center">


                                            <button type="submit" class="creative">
                                                <span class="shadoww"></span>
                                                <span class="edgee"></span>
                                                <span class="frontt text submit">Save Changes</span>
                                            </button>
                                        </div>
                                    </form>
                                @elseif (auth('author')->check())
                                    <form method="POST" action="{{ route('author.update', Auth::user()->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img src="{{ asset('attachments') . '/' . 'author' . Auth::user()->id . '/' . Auth::user()->img }}"
                                                    alt="Profile">
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="img" type="file"
                                                        class="  @error('img') is-invalid @enderror">
                                                    @error('img')
                                                        <span class="invalid-feedbackk">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label"> name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text"
                                                    class="form-control  @error('name') is-invalid @enderror"
                                                    value="{{ Auth::user()->name }}">
                                                @error('name')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label"> email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="text"
                                                    class="form-control  @error('email') is-invalid @enderror"
                                                    value="{{ Auth::user()->email }}">
                                                @error('email')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">
                                                experience</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="experience" type="text"
                                                    class="form-control  @error('experience') is-invalid @enderror"
                                                    value="{{ Auth::user()->experience }}">
                                                @error('experience')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">
                                                type_of_write</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="type_of_write" type="text"
                                                    class="form-control  @error('type_of_write') is-invalid @enderror"
                                                    value="{{ Auth::user()->type_of_write }}">
                                                @error('type_of_write')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label"> cvv</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text"
                                                    class="@error('cvv') is-invalid @enderror form-control placeicon"
                                                    name="cvv"minlength="3" maxlength="3"
                                                    value="{{ Auth::user()->cvv }}" placeholder="CVV">
                                                @error('cvv')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">
                                                card_number</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text"
                                                    class="@error('card_number') is-invalid @enderror form-control"
                                                    name="card_number" id="cr_no"
                                                    placeholder="card number 0000-0000-0000-0000" minlength="19"
                                                    maxlength="19" value="{{ Auth::user()->card_number }}"
                                                    placeholder="card number">
                                                @error('card_number')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">
                                                exp_date</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="month" name="exp_date"
                                                    value="{{ Auth::user()->exp_date }}" size="7" minlength="7"
                                                    maxlength="7" placeholder="expire date MM/YYYY"
                                                    class="@error('exp_date') is-invalid @enderror form-control placeicon">
                                                @error('exp_date')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="text-center">


                                            <button type="submit" class="creative">
                                                <span class="shadoww"></span>
                                                <span class="edgee"></span>
                                                <span class="frontt text submit">Save Changes</span>
                                            </button>
                                        </div>
                                    </form>
                                @elseif (auth('bookstore')->check())
                                    <form method="POST" action="{{ route('bookstore.update', Auth::user()->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img src="{{ asset('attachments') . '/' . 'bookstore' . Auth::user()->id . '/' . Auth::user()->img }}"
                                                    alt="Profile">
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="img" type="file"
                                                        class="  @error('img') is-invalid @enderror">
                                                    @error('img')
                                                        <span class="invalid-feedbackk">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label"> name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text"
                                                    class="form-control  @error('name') is-invalid @enderror"
                                                    value="{{ Auth::user()->name }}">
                                                @error('name')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label"> email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="text"
                                                    class="form-control  @error('email') is-invalid @enderror"
                                                    value="{{ Auth::user()->email }}">
                                                @error('email')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">
                                                bookstore_name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="bookstore_name" type="text"
                                                    class="form-control  @error('bookstore_name') is-invalid @enderror"
                                                    value="{{ Auth::user()->bookstore_name }}">
                                                @error('bookstore_name')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label"> phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text"
                                                    class="form-control  @error('phone') is-invalid @enderror"
                                                    value="{{ Auth::user()->phone }}">
                                                @error('phone')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">
                                                address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text"
                                                    class="form-control  @error('address') is-invalid @enderror"
                                                    value="{{ Auth::user()->address }}">
                                                @error('address')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label"> cvv</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text"
                                                    class="@error('cvv') is-invalid @enderror form-control placeicon"
                                                    name="cvv"minlength="3" maxlength="3"
                                                    value="{{ Auth::user()->cvv }}" placeholder="CVV">
                                                @error('cvv')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">
                                                card_number</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text"
                                                    class="@error('card_number') is-invalid @enderror form-control"
                                                    name="card_number" id="cr_no"
                                                    placeholder="card number 0000-0000-0000-0000" minlength="19"
                                                    maxlength="19" value="{{ Auth::user()->card_number }}"
                                                    placeholder="card number">
                                                @error('card_number')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">
                                                exp_date</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="month" name="exp_date"
                                                    value="{{ Auth::user()->exp_date }}" size="7" minlength="7"
                                                    maxlength="7" placeholder="expire date MM/YYYY"
                                                    class="@error('exp_date') is-invalid @enderror form-control placeicon">
                                                @error('exp_date')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="text-center">


                                            <button type="submit" class="creative">
                                                <span class="shadoww"></span>
                                                <span class="edgee"></span>
                                                <span class="frontt text submit">Save Changes</span>
                                            </button>
                                        </div>
                                    </form>
                                @elseif (auth('admin')->check())
                                <form method="POST" action="{{ route('admin.update', Auth::user()->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                            Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img src="{{ asset('attachments') . '/' . 'admin' . Auth::user()->id . '/' . Auth::user()->img }}"
                                                alt="Profile">
                                            <div class="col-md-8 col-lg-9">
                                                <input name="img" type="file"
                                                    class="  @error('img') is-invalid @enderror">
                                                @error('img')
                                                    <span class="invalid-feedbackk">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label"> name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text"
                                                class="form-control  @error('name') is-invalid @enderror"
                                                value="{{ Auth::user()->name }}">
                                            @error('name')
                                                <span class="invalid-feedbackk">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label"> email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="text"
                                                class="form-control  @error('email') is-invalid @enderror"
                                                value="{{ Auth::user()->email }}">
                                            @error('email')
                                                <span class="invalid-feedbackk">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-center">


                                        <button type="submit" class="creative">
                                            <span class="shadoww"></span>
                                            <span class="edgee"></span>
                                            <span class="frontt text submit">Save Changes</span>
                                        </button>
                                    </div>

                                </form>
                                @endif


                            </div>




                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
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
