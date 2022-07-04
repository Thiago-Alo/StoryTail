@extends('auth.layouts.main_login')


@section('content_login')

<body class="body-login" onload="document.getElementById('flip').click()">
<div class="container-login">
    <input type="checkbox" id="flip">
    <div class="cover">
        <div class="front">
            <img src="{{asset('storage/images/login/login1.jpg')}}" alt="">
        </div>
    </div>

    <form class="form-style" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-content " style="justify-content: end">
            <div class="signup-form">
                <div class="title">Signup</div>
                <div class="input-boxes">
                    <div class="input-box">
                        <i class="fas fa-envelope"></i>
                        <input  class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="Enter your email" value="{{ old('email') }}" required
                                autocomplete="email" maxlength="50">
                    </div>
                    @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong></span>
                    @enderror


                    <div class="input-box">
                        <i class="fas fa-user"></i>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                               id="name" value="{{ old('name') }}" placeholder="Enter your first and last name" required
                               autocomplete="name" autofocus maxlength="50">
                    </div>

                    @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong></span>
                    @enderror

                    <div class="input-box">
                        <i class="fas fa-user"></i>
                        <input onfocus="(this.type='date')" class="form-control @error('age') is-invalid @enderror" type="text" name="age"
                               id="age" value="{{ old('age') }}" placeholder="Enter your date of birth" required
                                >
                    </div>

                    @error('age')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong></span>
                    @enderror

                    <div class="input-box">
                        <i class="fas fa-lock"></i>
                        <input class="form-control @error('password') is-invalid @enderror" type="password"
                               name="password" id="password" placeholder="Enter your password" required
                               autocomplete="new-password" maxlength="50" >
                    </div>
                    @error('password')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong></span>
                    @enderror
                    <div class="input-box">
                        <i class="fas fa-lock"></i>
                        <input class="form-control" type="password" name="password_confirmation" id="password-confirm"
                               placeholder="Confirm your password" required autocomplete="new-password" maxlength="50">
                    </div>
                    <div class="button input-box">
                        <input type="submit" value="Submit">
                    </div>
                    <div class="text sign-up-text">Already have an account? <br> <a href="{{ route('login') }}">Login now</a>
                    </div>
                </div>
            </div>

        </div>
    </form>

</div>
</body>
@endsection
