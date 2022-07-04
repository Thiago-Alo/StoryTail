@extends('master.main_admin')

@section('styles')
    {{-- <link rel="stylesheet" href="{{asset('css/login_style.css')}}">--}}


@endsection

@section('content-admin')



        <div class="container container-custom-size-min customBoxShadow  p-4 mt-5"  >
            <form  method="POST" id="formAgeGroupEdit"  action="{{route('age-range.update',[$ageGroup])}}" >
                @method('PUT')
                @csrf
            <div class="row">
                <div class="col text-center my-auto">
            <H2 class="text-center ">EDIT AGE RANGE</H2>
                    <H2 class="text-center "> {{strtoupper($ageGroup->age_group)}}</H2>
                </div>
            </div>
            <hr>

                <div class="form-row my-2">
                    <div class="col-lg-6 text-center">
                        <label class="labelBoxFormNewBook" for="minimumAge">Minimum Age</label>
                        <input  placeholder="Enter the minimum age (0-99)..."  type="number"  required autofocus name="minimumAge" id="minimumAge" class="inputBoxFormNewBook form-control @error('minimumAge') is-invalid @enderror"  value="{{Str::beforeLast($ageGroup->getRawOriginal('age_group'), ' ')}}"  >
                        @error('minimumAge')
                        <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                        @enderror
                    </div>

                    <div class="col-lg-6 text-center">
                        <label class="labelBoxFormNewBook" for="maximumAge">Maximum Age</label>
                        <input  placeholder="Enter the maximum age (1-99)..." type="number"   name="maximumAge" id="maximumAge" class="inputBoxFormNewBook form-control @error('maximumAge') is-invalid @enderror"  value="{{Str::afterLast($ageGroup->getRawOriginal('age_group'), ' ')}}"  >
                        @error('maximumAge')
                        <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                        @enderror
                    </div>


                </div>

                <div class="form-group text-center">
                    <button class="buttonSubmitFormat show_confirm_ageGroupEdit mt-3" type="submit">Submit</button>
                </div>
            </form>
        </div>


@endsection
@section('scripts')


    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/alert_dialog.js') }}"></script>

@endsection





