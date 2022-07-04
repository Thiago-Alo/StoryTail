@extends('auth.layouts.main_validation')
@section('content_validation')

<div class="container-msg">
    <div class="wrapper-txt">
        <ul class="dynamic-txts">
            <li><span>Adventure</span></li>
            <li><span>Magic</span></li>
            <li><span>Monsters</span></li>
            <li><span>Fiction</span></li>
        </ul>
        <div class="static-txt">Stories</div>
        <img src="{{asset('storage/images/login/raposa4-removebg-preview.png')}}" alt="">
    </div>
</div>
<div class="container-msg-body">
    <img src="{{asset('storage/images/login/bg3-removebg-preview.png')}}" alt="">
    <div class="msg-body">
        <!--NAME NO REGISTO-->
        <span class="text-msg-body">Welcome,<br>{{Auth::user()->name}}</span>
        <!--TEXT 1-->
        <p>You are almost done.</p>

        <!--TEXT 2-->
        <p>Please wait for your account to be validated by the teacher.</p>

        <!--BUTTON LOGOUT-->
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
</body>
</html>
@endsection
