@extends('master.main_admin')

@section('styles')
    {{-- <link rel="stylesheet" href="{{asset('css/login_style.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/filepond.css')}}">

    <link rel="stylesheet" href="{{asset('css/bootstrap-select.css')}}">

@endsection

@section('content-admin')


    <div class="container container-custom-size-min customBoxShadow p-4 mt-5">
        <H1 class="text-center ">NEW AUDIO</H1>
        <hr>
        <form method="POST" id="formNewAudio"  action="{{route('audio.store')}}"
              enctype="multipart/form-data">

            @csrf
            <div class="form-row my-2">
                <div class="col-12">
                    <label class="labelBoxFormNewBook" for="bookId">Book Title</label>
                    <select data-max-options="1" required multiple
                            title="Choose a book..." class="selectpicker show-tick border rounded form-control inputBoxFormNewBook  @error('bookId') is-invalid @enderror"
                            name="bookId" id="bookId" data-width="100%" data-live-search="true"
                            data-actions-box="false">
                        @foreach($books as $book)
                            <option class="inputBoxFormNewBook  @error('bookId') is-invalid @enderror"
                                    value="{{$book->id}}">{{$book->title}}</option>
                        @endforeach
                    </select>
                    @error('bookId')
                    <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                    @enderror
                </div>

            </div>

            <div class="form-row my-2">
                <div class="col">
                    <label class="labelBoxFormNewBook" for="bookAudio">Upload your audio</label>
                    <input required type="file" name="bookAudio" value="{{ old('bookAudio') }}" id="bookAudio"
                           class="filepond border rounded  @error('bookAudio') is-invalid @enderror">
                    @error('bookAudio')
                    <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                    @enderror
                </div>
            </div>

            <div class="form-group text-center">
                <button class="buttonSubmitFormat mt-3 show_confirm_newaudio" type="submit">Submit</button>
            </div>
        </form>
    </div>



@endsection
@section('scripts')







    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/alert_dialog.js') }}"></script>
    <script src="{{ asset('js/filepond_script.js') }}"></script>
    <script src="{{ asset('js/filepond_validation.js') }}"></script>


    <script>
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        const inputElement = document.querySelector('input[id="bookAudio"]');
        const pond = FilePond.create(inputElement, {
                labelIdle: `Drag & Drop your audio file or <span class="filepond--label-action"> Browse </span>`,
                acceptedFileTypes: ['audio/*','video/*'],
                credits: '',

            }
        );
        FilePond.setOptions({
            server:
                {
                    url: 'upload-audio',
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }

                }
        });


    </script>
    <script src="{{asset('js/bootstrap-select.js')}}" defer></script>

@endsection





