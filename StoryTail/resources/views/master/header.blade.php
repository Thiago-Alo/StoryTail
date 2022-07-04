<header>

    <nav class="navbarStory">
        <ul>
            <li class="logo"></li>
            <li class="btn" [data-anime="hamburguer"]><span class="fas fa-bars"></span></li>
            <div class="items-nav">

                @can('admin')

                    <li>
                        <a href="{{route('admin')}}"><span class="menu-word">
                        <span class="f-word" data-hover="Ad">Ad</span>
                        <span class="s-word" data-hover="min">min</span>
                        </span></a>
                    </li>


                @endcan
                <li>
                    <a href="{{route('home')}}"><span class="menu-word">
                        <span class="f-word" data-hover="Ho">Ho</span>
                        <span class="s-word" data-hover="me">me</span>
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('contact')}}"><span class="menu-word">
                            <span class="f-word" data-hover="Cont">Cont</span>
                            <span class="s-word" data-hover="act">act</span>
                        </span></a>
                </li>
                    <li>
                        <a href="{{route('my-account',[Auth()->user()])}}"><span class="menu-word">
                        <span class="f-word" data-hover="My">My</span>
                        <span class="s-word" data-hover="Account">Account</span>
                        </span></a>
                    </li>

                    <li>
                        <a href="{{route('wordle')}}"><span class="menu-word">
                        <span class="f-word" data-hover="Wor">Wor</span>
                        <span class="s-word" data-hover="dle">dle</span>
                        </span></a>
                    </li>


                <li>
                    <a href="{{ route('logout') }}"onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        <span class="menu-word">
                            <span class="f-word" data-hover="Log">Log</span>
                            <span class="s-word" data-hover="out">out</span>
                        </span> </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </li>
            </div>
            <form class="d-flex align-items-center" action="{{route('home')}}" method="get">
            <li class="search-icon SearchBoxHome">
                <input type="search" name="search" placeholder="Search your book">
                <span><button class="btn" ></button></span>
            </li>
            </form>
        </ul>
    </nav>
</header>
