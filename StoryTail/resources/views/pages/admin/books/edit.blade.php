@extends('master.main_admin')

@section('styles')
    {{-- <link rel="stylesheet" href="{{asset('css/login_style.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/filepond.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.css')}}">
    <link rel="stylesheet" href="{{asset('css/filepond_preview.css')}}">

@endsection

@section('content-admin')



        <div class="container customBoxShadow  p-4 mt-5" >
            <div class="row">
                <div class="col-md-8 text-center my-auto">
            <H1 class="text-center ">EDITING BOOK</H1>
            <H1 class="text-center "> {{strtoupper($book->title)}}</H1>
                </div>
                <div class=" col-md-4">
                    <div class="coverBookParentClass">
                    <div class="coverBookBoxCard" >
                <embed class="coverBook"   src="{{asset("$book->cover#toolbar=0")}}">

                    </div>
                    </div>
            </div>
            </div>
            <hr>
            <form  method="POST" id="formEditBook"  action="{{route('books.update',[$book])}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-row my-2">
                    <div class="col-md-8">
                        <label class="labelBoxFormNewBook" for="title">Title</label>
                        <input placeholder="Enter the book title..." type="text" maxlength="50" required autofocus name="title" id="title" class="inputBoxFormNewBook form-control @error('title') is-invalid @enderror"  value="{{$book->title}}"  >
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
                                <option @foreach($book->ageGroups as $ageGroupBook) @if($ageGroupBook->id==$ageGroup->id) selected @endif @endforeach class="inputBoxFormNewBook @error('ageGroup') is-invalid @enderror"  value="{{$ageGroup->id}}" >{{$ageGroup->age_group}}</option>
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
                        <label class="labelBoxFormNewBook"  for="author">Authors</label>
                        <select required multiple
                                title="Choose at least one author..." class="selectpicker show-tick border rounded form-control inputBoxFormNewBook  @error('author') is-invalid @enderror"
                                name="author[]" id="author" data-width="100%" data-live-search="true" data-actions-box="true">
                            @foreach($authors as $author)
                                <option @foreach($book->authors as $bookAuthor) @if($bookAuthor->id==$author->id) selected @endif @endforeach class="inputBoxFormNewBook  @error('author') is-invalid @enderror"
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
                        <input placeholder="Enter the name of the illustrator..." type="text" maxlength="40" name="illustrator" id="illustrator" class="inputBoxFormNewBook form-control @error('illustrator') is-invalid @enderror"  value="{{ $book->illustrator }}"  >
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
                                  class="inputBoxFormNewBook form-control @error('summary') is-invalid @enderror"
                        >{{ $book->summary}}</textarea>
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
                                <option @foreach($book->activityTypes as $bookActivity) @if($bookActivity->id==$activityType->id) selected @endif @endforeach class="inputBoxFormNewBook @error('bookTheme') is-invalid @enderror"
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
                                <option @foreach($book->themes as $bookTheme) @if($bookTheme->id==$theme->id) selected @endif @endforeach class="inputBoxFormNewBook @error('bookTheme') is-invalid @enderror"
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
                               >{{ $book->activity }}</textarea>
                        @error('activity')
                        <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                        @enderror
                    </div>




                </div>

                <div class="form-row my-2">
                    <div class="col-md-6">
                        <label class="labelBoxFormNewBook" for="bookPDF">Upload your book</label>
                        <input type="file"   name="bookPDF" value="{{ old('bookPDF') }}" id="bookPDF" class="filepond border rounded  @error('bookPDF') is-invalid @enderror"  >
                        @error('bookPDF')
                        <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="labelBoxFormNewBook" for="cover">Change the book cover</label>
                        <input type="file"   name="cover" value="{{ old('cover') }}" id="cover" class="filepond border rounded  @error('cover') is-invalid @enderror"  >
                        @error('cover')
                        <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                        @enderror
                    </div>

                </div>
                <div class="form-group text-center">
                    <button class="buttonSubmitFormat show_confirm_editbook mt-3" type="submit">Submit</button>
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
        const inputElement = document.querySelector('input[id="bookPDF"]');
        const inputElement2 = document.querySelector('input[id="cover"]');
        const pond = FilePond.create(inputElement,{
                labelIdle: `Drag & Drop your pdf file or <span class="filepond--label-action"> Browse </span>`,
                acceptedFileTypes: ['application/pdf'],
                credits: '',

            server:
                {
                    url:'../upload-temp',
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }

                }

            }

        );

        const pond2 = FilePond.create(inputElement2,{
                labelIdle: `Drag & Drop your pdf/img file or <span class="filepond--label-action"> Browse </span>`,
                acceptedFileTypes: ['application/pdf','image/*'],
                credits: '',

            server:
                {
                    url:'../upload-temp-cover',
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }

                }

            }

        );




    </script>
    <script src="{{asset('js/bootstrap-select.js')}}" defer></script>
@endsection





