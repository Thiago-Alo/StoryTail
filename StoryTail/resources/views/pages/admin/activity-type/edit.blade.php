@extends('master.main_admin')

@section('styles')
    {{-- <link rel="stylesheet" href="{{asset('css/login_style.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/filepond.css')}}">
    <link rel="stylesheet" href="{{asset('css/filepond_preview.css')}}">

@endsection

@section('content-admin')

        <div class="container container-custom-size customBoxShadow  p-4 mt-5"  >
            <form  method="POST" id="formActivityTypeEdit"  action="{{route('activity-type.update',[$activityType])}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
            <div class="row">
                <div class="col-sm-8 text-center my-auto mx-auto">
            <H2 class="text-center ">EDIT ACTIVITY THEME</H2>
                    <H2 class="text-center "> {{strtoupper($activityType->type)}}</H2>

                </div>

                <div class=" col-md-4">
                    <div class="iconActivityThemeParentClass">
                        <div class="iconActivityThemeBoxCard" >
                            @if($activityType->activity_image!=null)
                            <embed class="iconActivityTheme"   src="{{asset($activityType->activity_image)}}">
                            @endif

                        </div>
                    </div>

            </div>
            </div>
            <hr>

                <div class="form-row my-2">
                    <div class="col text-center">
                        <label class="labelBoxFormNewBook" for="theme">Activity Theme</label>
                        <input  placeholder="Enter the activity theme..." type="text" maxlength="50" required autofocus name="theme" id="theme" class="inputBoxFormNewBook form-control @error('theme') is-invalid @enderror"  value="{{$activityType->type}}"  >
                        @error('theme')
                        <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                        @enderror
                    </div>





                </div>
                <div class="form-row my-2">
                <div class="col  text-center my-auto mx-auto ">
                    <label class="labelBoxFormNewBook" for="activityImage">Upload new icon</label>
                    <input type="file" name="activityImage" id="activityImage" class="filepond border rounded  @error('activityImage') is-invalid @enderror"  >
                    @error('activityImage')
                    <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                    @enderror
                </div>
                </div>

                <div class="form-group text-center">
                    <button class="buttonSubmitFormat show_confirm_activityThemeEdit mt-3" type="submit">Submit</button>
                </div>
            </form>
        </div>


@endsection
@section('scripts')


    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/alert_dialog.js') }}"></script>
    <script src="{{ asset('js/filepond_script.js') }}"></script>
    <script src="{{ asset('js/filepond_validation.js') }}"></script>
    <script src="{{ asset('js/filepond_preview.js') }}"></script>

    <script>
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        FilePond.registerPlugin(FilePondPluginImagePreview);
        const inputElement = document.querySelector('input[id="activityImage"]');
        const pond = FilePond.create(inputElement,{
                labelIdle: `Drag & Drop your image file or <span class="filepond--label-action"> Browse </span>`,
                acceptedFileTypes: ['image/*'],
                credits: '',

            server:
                {
                    url:'../upload-activity-type',
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }

                }

            }

        );


    </script>

@endsection





