

<div class="mx-auto my-auto text-center" id="onMouseOverSideBar"  onmouseover="openNav()">

        <button  id="buttonnav" class="openbtn text-center mx-auto my-auto"  onclick="openNav()">☰</button >

</div>

<div id="mySidebar" class="sidebar" onmouseleave="closeNav()"  >

    <div style="padding:  8px 8px 8px 10px;">
    <img class=" img-fluid w-100  mx-auto my-auto" src="{{asset('storage/images/login/logo1.png')}}" alt="">
    </div>


   {{-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>--}}



    <div id="panelAdmin"  >

        <a class="pinMenuButton"  onclick="pinMenu()" id="pinButton"  ><i class="fa-solid fa-thumbtack  pr-2" style="font-size: 1.3rem;"></i>Pin sidebar</a>

        <a class="pinMenuButton"  onclick="unpinMenu()" id="unpinButton"  style="display: none"><i class="fa-solid fa-minus  pr-2" style="font-size: 1.3rem;"></i>Unpin sidebar</a>

        <hr style="background-color: white;margin-top: 2px;margin-bottom: 10px">

    <a href="{{route('admin')}}" class="@if(Request::is('admin')) activeSideBar @endif " ><i class="fa-solid fa-house pr-2" style="font-size: 1.3rem;" ></i>HOME</a>

    <a href="{{route('books.list')}}" class="@if(Request::is('admin/books')) activeSideBar @endif "><i class="fa-solid fa-book-open pr-2" style="font-size: 1.3rem"></i>LIST OF BOOKS</a>
    <a href="{{route('users.list')}}" class="@if(Request::is('admin/users')) activeSideBar @endif "><i class="fa-solid fa-user-group pr-2" style="font-size: 1.2rem" ></i>LIST OF USERS</a>

        <a class="dropdown-btn-audio" href="#"><i class=" fa-solid fa-file-audio pr-2 " style="font-size: 1.5rem"></i> AUDIO</a>
        <div class="dropdown-container">
            <a href="{{route('audio.create')}}" class="@if(Request::is('admin/audio/create')) activeSideBar @endif ">NEW</a>
            <a href="{{route('audio.list')}}" class="@if(Request::is('admin/audio')) activeSideBar @endif ">LIST OF AUDIOS</a>
        </div>

    <a class="dropdown-btn" href="#"><i class=" fa-solid fa-file-circle-plus pr-2 " style="font-size: 1.3rem"></i>NEW</a>
    <div class="dropdown-container">
    <a href="{{route('activity-type.create')}}" class="@if(Request::is('admin/activity-theme/create')) activeSideBar @endif ">ACTIVITY THEME</a>
    <a href="{{route('age-range.create')}}" class="@if(Request::is('admin/age-range/create')) activeSideBar @endif ">AGE RANGE</a>
    <a href="{{route('author.create')}}" class="@if(Request::is('admin/author/create')) activeSideBar @endif ">AUTHOR</a>
    <a href="{{route('books.create')}}" class="@if(Request::is('admin/books/create')) activeSideBar @endif ">BOOK</a>
    <a href="{{route('book-theme.create')}}" class="@if(Request::is('admin/book-theme/create')) activeSideBar @endif ">BOOK THEME</a>
    </div>




        <a   href="{{route('home')}}"  ><i class="fa-solid fa-door-open pr-2" style="font-size: 1.3rem" ></i>EXIT PANEL</a>
        <a   href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" ><i class="fa-solid fa-right-from-bracket pr-2" style="font-size: 1.4rem" ></i>LOGOUT</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>






