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
    <!--LETTER BODY-->
    <div class="msg-body-email">
        <!--NAME NO REGISTO-->
        <span class="text-msg-body-email">Welcome<br></span>
        <!--TEXT 1-->
        <label class="text-msg-body-email">  Password Recovery.</label>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="inputs-email">
                    <label for="email">Enter your e-mail address</label>
                    <input style="font-size: 18px" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    <button type="submit" class="btn-email">
                        {{ __('Send Password') }}
                    </button>
                </div>
            </form>
                <a style="font-size:25px; padding:0px 10px 0px 10px;" href="{{route('login')}}">Go back</a>
            </div>
        </div>
    </div>

</div>
@endsection
