@extends('master.main_admin')

@section('styles')
    {{-- <link rel="stylesheet" href="{{asset('css/login_style.css')}}">--}}


@endsection

@section('content-admin')



        <div class="container container-custom-size-min customBoxShadow  p-4 mt-5"  >
            <form  method="POST" id="formThemeEdit"  action="{{route('book-theme.update',[$theme])}}" >
                @method('PUT')
                @csrf
            <div class="row">
                <div class="col text-center my-auto">
            <H2 class="text-center ">EDIT BOOK THEME</H2>
                    <H2 class="text-center "> {{strtoupper($theme->name)}}</H2>
                </div>
            </div>
            <hr>

                <div class="form-row my-2">
                    <div class="col text-center">
                        <label class="labelBoxFormNewBook" for="theme">Theme Name</label>
                        <input  placeholder="Enter the theme name..." type="text" maxlength="40" required autofocus name="theme" id="theme" class="inputBoxFormNewBook form-control @error('theme') is-invalid @enderror"  value="{{$theme->name}}"  >
                        @error('theme')
                        <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                        @enderror
                    </div>


                </div>

                <div class="form-group text-center">
                    <button class="buttonSubmitFormat show_confirm_themeEdit mt-3" type="submit">Submit</button>
                </div>
            </form>
        </div>


@endsection
@section('scripts')


    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/alert_dialog.js') }}"></script>

@endsection





