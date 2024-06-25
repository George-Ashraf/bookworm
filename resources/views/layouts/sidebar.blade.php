<div class="navigation">
    <ul>
        <li>
            <a href="{{ route('admin.home') }}">
                <span class="icon"><i class="fa-solid fa-house"></i></span>
                <span class="title">home</span>
            </a>
        </li>
        <li>
            <a href="{{route('dashboard.index')}}">
                <span class="icon"><i class="fa-solid fa-users"></i> <i class="fa-solid fa-book"></i></span>
                <span class="title">users and books</span>
            </a>
        </li>
        <li>
            <a href="{{route('delivery.index')}}">
                <span class="icon"><i class="fa-solid fa-truck"></i></span>
                <span class="title">delivery</span>
            </a>
        </li>
        <li>
            <a href="{{route('revenue.index')}}">
                <span class="icon"><i class="fa-solid fa-hand-holding-dollar"></i></span>
                <span class="title">revenue </span>
            </a>
        </li>
        <li>
            <a href="{{route('bookpanel.all')}}">
                <span class="icon"><i class="fa-solid fa-book"></i></span>
                <span class="title">book panel</span>
            </a>
        </li>

        <li>
            <a href="{{route('about.index2')}}">
                <span class="icon"><i class="fa-solid fa-message"></i></span>
                <span class="title">Messages</span>
            </a>
        </li>


    </ul>
</div>
<div class="toggle"  onclick="togglemenu()"></div>
