@extends('master.main_admin')

@section('styles')
    {{-- <link rel="stylesheet" href="{{asset('css/login_style.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/filepond.css')}}">

    <link rel="stylesheet" href="{{asset('css/bootstrap-select.css')}}">

@endsection

@section('content-admin')


        <div class="container customBoxShadow p-4 mt-5">
            <H1 class="text-center ">NEW BOOK</H1>
            <hr>
            <form method="POST" id="formNewBook"  action="{{route('books.store')}}"
                  enctype="multipart/form-data">

                @csrf
                <div class="form-row my-2">
                    <div class="col-md-8">
                        <label class="labelBoxFormNewBook" for="title">Title</label>
                        <input placeholder="Enter the book title..." type="text" maxlength="50" required autofocus
                               name="title" id="title"
                               class="inputBoxFormNewBook form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}">
                        @error('title')
                        <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="labelBoxFormNewBook" for="ageGroup">Age Group</label>
                        <select required multiple
                                title="Choose at least one age range..." class="selectpicker show-tick border rounded form-control inputBoxFormNewBook  @error('ageGroup') is-invalid @enderror"
                                name="ageGroup[]" id="ageGroup" data-width="100%" data-live-search="true"
                                data-actions-box="true">
                            @foreach($ageGroups as $ageGroup)
                                <option class="inputBoxFormNewBook  @error('ageGroup') is-invalid @enderror"
                                         value="{{$ageGroup->id}}">{{$ageGroup->age_group}}</option>
                            @endforeach
                        </select>
                        @error('ageGroup')
                        <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                        @enderror
                    </div>

                </div>
                <div class="form-row my-2">
                    <div class="col-md-6">
                        <label class="labelBoxFormNewBook" for="author">Authors</label>
                        <select required multiple
                                title="Choose at least one author..." class="selectpicker show-tick border rounded form-control inputBoxFormNewBook  @error('author') is-invalid @enderror"
                                name="author[]" id="author" data-width="100%" data-live-search="true" data-actions-box="true">
                            @foreach($authors as $author)
                                <option class="inputBoxFormNewBook  @error('author') is-invalid @enderror"
                                        value="{{$author->id}}">{{$author->name}}</option>
                            @endforeach
                        </select>
                        @error('author')
                        <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="labelBoxFormNewBook" for="illustrator">Illustrator</label>
                        <input placeholder="Enter the name of the illustrator..." type="text" maxlength="40"
                               name="illustrator" id="illustrator"
                               class="inputBoxFormNewBook form-control @error('illustrator') is-invalid @enderror"
                               value="{{ old('illustrator') }}">
                        @error('illustrator')
                        <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row my-2">

                    <div class="col">
                        <label class="labelBoxFormNewBook" for="summary">Summary</label>
                        <textarea required placeholder="Enter a brief description of the book (maximum 200 characters)..." rows="2" type="text" maxlength="200"
                                  name="summary" id="summary"
                                  class="inputBoxFormNewBook  form-control @error('summary') is-invalid @enderror"
                        >{{ old('summary') }}</textarea>

                        @error('summary')
                        <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                        @enderror
                    </div>
                </div>
                <div class="form-row my-2">

                    <div class="col-md-6">
                        <label class="labelBoxFormNewBook" for="activityType">Activity Themes</label>
                        <select multiple data-width="100%" title="Choose at least one theme..."
                                data-live-search="true"
                                data-actions-box="true"
                                class="selectpicker show-tick border rounded form-control   inputBoxFormNewBook @error('activityType') is-invalid @enderror"
                                name="activityType[]" id="activityType">
                            @foreach($activityTypes as $activityType)
                                <option class="inputBoxFormNewBook @error('bookTheme') is-invalid @enderror"
                                        value="{{$activityType->id}}">{{$activityType->type}}</option>
                            @endforeach

                        </select>
                        @error('activityType')
                        <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="labelBoxFormNewBook" for="bookTheme">Book Themes</label>
                        <select required data-width="100%" title="Choose at least one theme..." multiple
                                data-actions-box="true"
                                data-live-search="true"
                                class="selectpicker show-tick border rounded form-control   inputBoxFormNewBook @error('bookTheme') is-invalid @enderror"
                                name="bookTheme[]" id="bookTheme">
                            @foreach($themes as $theme)
                                <option class="inputBoxFormNewBook @error('bookTheme') is-invalid @enderror"
                                        value="{{$theme->id}}">{{$theme->name}}</option>
                            @endforeach

                        </select>
                        @error('bookTheme')
                        <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                        @enderror
                    </div>


                </div>
                <div class="form-row my-2">
                    <div class="col">
                        <label class="labelBoxFormNewBook" for="activity">Activity Description</label>
                        <textarea placeholder="Enter a brief description of the activity (maximum 200 characters)..." rows="2" type="text" maxlength="200"
                                  name="activity" id="activity"
                                  class="inputBoxFormNewBook form-control @error('activity') is-invalid @enderror"
                        >{{ old('activity') }}</textarea>
                        @error('activity')
                        <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                        @enderror
                    </div>


                </div>
                <div class="form-row my-2">
                    <div class="col">
                        <label class="labelBoxFormNewBook" for="bookPDF">Upload your book</label>
                        <input required type="file" name="bookPDF" value="{{ old('bookPDF') }}" id="bookPDF"
                               class="filepond border rounded  @error('book') is-invalid @enderror">
                        @error('bookPDF')
                        <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group text-center">
                    <button class="buttonSubmitFormat mt-3 show_confirm_newbook" type="submit">Submit</button>
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
        const inputElement = document.querySelector('input[id="bookPDF"]');
        const pond = FilePond.create(inputElement, {
                labelIdle: `Drag & Drop your pdf file or <span class="filepond--label-action"> Browse </span>`,
                acceptedFileTypes: ['application/pdf'],
                credits: '',

            }
        );
        FilePond.setOptions({
            server:
                {
                    url: 'upload-temp',
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }

                }
        });


    </script>
    <script src="{{asset('js/bootstrap-select.js')}}" defer></script>

@endsection





