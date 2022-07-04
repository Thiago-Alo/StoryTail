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
    <div class="msg-body-reset">
        <!--NAME NO REGISTO-->
        <span class="text-msg-body">Welcome<br></span>

        <!--TEXT 1-->
        <label class="text-msg-body">{{ __('Reset Password') }}</label>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value=" $token }}">
            <!--INPUTS-->
            <div class="inputs-reset">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                <button type="submit" class="btn-email">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
        <a style="font-size:25px; padding:0px 10px 0px 10px;"  href="{{route('login')}}">Go back</a>
    </div>
</div>
@endsection
