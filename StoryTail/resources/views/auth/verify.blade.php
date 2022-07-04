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
      @if(auth()->check()&&!auth()->user()->hasVerifiedEmail())

       <p>Please check your email for a verification link.</p>

        @if (!session('resent'))
        <form id="form-resend" class="d-inline d-none" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        </form>
            <button form="form-resend" type="submit" class="btn btn-link p-0 m-0 align-baseline font-weight-bold" style="font-size: 20px;color: #E95A0C">{{ __('Click here to request another.') }}</button>.
        @endif
        @if (session('resent'))
            <div class="alert-success align-baseline"  role="alert" style="font-size: 20px">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
    @endif
    @endif
        <!--TEXT 2-->
        @if(auth()->check()&&!auth()->user()->active)
        <p>Please wait for your account to be validated by the teacher.</p>
    @endif
        <!--BUTTON LOGOUT-->
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
@endsection
