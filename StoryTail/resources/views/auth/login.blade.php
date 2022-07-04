@extends('auth.layouts.main_login')


@section('content_login')
<body class="body-login" >
<div class="container-login">
    <input type="checkbox" id="flip">
    <div class="cover">
        <div class="front">
            <img src="{{asset('storage/images/login/login1.jpg')}}" alt="">
        </div>

    </div>

    <form class="form-style" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-content ">
            <div class="login-form">
                <div class="title">Login <img src="{{asset('storage/images/login/logo1.png')}}" alt=""></div>
                <div class="input-boxes">
                    <div class="input-box">

                        <i class="fas fa-envelope"></i>
                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                               id="email"
                               placeholder="Enter your email" value="{{ old('email') }}" required autocomplete="email"
                               autofocus>
                    </div>
                    @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <div class="input-box">
                        <i class="fas fa-lock"></i>
                        <input class=" form-control @error('password') is-invalid @enderror" type="password"
                               name="password" id="password" placeholder="Enter your password" required
                               autocomplete="current-password">
                    </div>
                    @error('password')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong></span>
                    @enderror
                    <!--CHECK BOX-->
                    <div class="login-checkbox ">
                        <div class="d-block">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">Remember me</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                    <!--END CHECKBOX-->
                    <!--BUTTON SUBMIT-->
                    <div class="button input-box">
                        <input type="submit" value="Submit">
                    </div>
                    <div class="text login-text">Don't have an account? <br> <a href="{{ route('register') }}">Signup now</a></div>
                </div>
            </div>
            <div class="signup-form" style="visibility: hidden">
                <div class="title">Signup</div>
                <div class="input-boxes">
                    <div class="input-box">
                        <i class="fas fa-user"></i>
                        <input type="text">
                    </div>
                    <div class="input-box">
                        <i class="fas fa-envelope"></i>
                        <input type="text" >
                    </div>
                    <div class="input-box">
                        <i class="fas fa-envelope"></i>
                        <input type="text" >
                    </div>
                    <div class="input-box">
                        <i class="fas fa-lock"></i>
                        <input type="password" >
                    </div>
                    <div class="input-box">
                        <i class="fas fa-lock"></i>
                        <input type="password">
                    </div>
                    <div class="button input-box">
                        <input type="text">
                    </div>
                    <div class="text sign-up-text">Already have an account? <br> <label for="flip">Login now</label></div>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
@endsection
