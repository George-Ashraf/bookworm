<header>
    <div class="sidee">
        <img src="{{ asset('assets/img/bookworm.png') }}" alt="logo"> bookworm
    </div>
    <nav>
        <ul>
            @if (auth('author')->check())
                <li><a href="{{ route('author.home') }}">home</a></li>
                <li><a href="{{ route('bookpanel.all') }}">book panel</a></li>
            @elseif(auth('admin')->check())
                <li><a href="{{ route('admin.home') }}">home</a></li>
                <li><a href="{{ route('dashboard.index') }}">dashboard</a></li>
            @elseif(auth('bookstore')->check())
                <li><a href="{{ route('bookstore.home') }}">home</a></li>
                <li><a href="{{ route('bookpanel.all') }}"> book panel</a></li>
                @else
                <li><a href="{{ route('home') }}">home</a></li>
            @endif
            <li><a href="{{route('about.index')}}">about</a></li>
            <li><a href="{{ route('product.index') }}">books</a></li>
            @if (auth('admin')->check()|| auth('web')->check())
            <li><a href="{{ route('booksharingsection.index') }}">booksharing</a></li>
            <li><a href="{{route('seminar.index')}}">seminars</a></li>
            @endif

            @guest
            <li><a href="{{ route('booksharingsection.index') }}">booksharing</a></li>
            <li><a href="{{route('seminar.index')}}">seminars</a></li>
            @endguest


        </ul>
    </nav>
    <div class="sidee">
        @auth
            <div class="dropdown">
                <button class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                    @if (auth('author')->check())
                        <p>author</p>
                    @elseif(auth('admin')->check())
                        <p>admin</p>
                    @elseif(auth('bookstore')->check())
                        <p>bookstore</p>
                    @else
                        <p>user</p>
                    @endif
                </button>
                <div class="dropdown-menu">

                    @if (auth('author')->check())
                        <form method="GET" action="{{ route('logout', 'author') }}">
                        @elseif(auth('admin')->check())
                            <form method="GET" action="{{ route('logout', 'admin') }}">
                            @elseif(auth('bookstore')->check())
                                <form method="GET" action="{{ route('logout', 'bookstore') }}">
                                @else
                                    <form method="GET" action="{{ route('logout', 'web') }}">
                    @endif

                    @csrf
                    <a href="{{route('profile')}}">
                        <p class="dropdown-item"><i class="fa-solid fa-user"></i>profile</p>

                    </a>
                    @if (auth('web')->check())
                        <a href="{{ route('book.purchased') }}">
                            <p class="dropdown-item"><i class="fa-solid fa-money-bill"></i>purchased book</p>
                        </a>
                    @endif

                    <a class="dropdown-item" href="#"
                        onclick="event.preventDefault();this.closest('form').submit();"><i
                            class="fa-solid fa-right-from-bracket"></i>log out</a>


                    </form>


                </div>
            </div>
        @else
            @if (Route::has('login'))
                <button class="creative">
                    <span class="shadoww"></span>
                    <span class="edgee"></span>
                    <a href="{{ route('selection') }}"><span class="frontt text"> log in </span></a>
                </button>
            @endif
        @endauth



    </div>
    <div class="menu-toggle"><i class="fa-solid fa-bars"></i></div>
</header>
