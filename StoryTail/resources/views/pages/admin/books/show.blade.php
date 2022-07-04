@extends('master.main_admin')

@section('styles')
    {{-- <link rel="stylesheet" href="{{asset('css/login_style.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.css')}}">

@endsection

@section('content-admin')



        <div class="container customBoxShadow  p-4 mt-5" >
            <div class="row">
                <div class="col-md-8 text-center my-auto">
            <H1 class="text-center ">VIEW BOOK</H1>
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
            <form  method="POST"  action="" disabled="">

                <div class="form-row my-2">
                    <div class="col-md-8">
                        <label class="labelBoxFormNewBook" for="title">Title</label>
                        <input disabled placeholder="Enter the book title..." type="text" maxlength="50" required autofocus name="title" id="title" class="inputBoxFormNewBook form-control"  value="{{$book->title}}"  >

                    </div>

                    <div class="col-md-4">
                        <label class="labelBoxFormNewBook" for="ageGroup">Age Group</label>
                        <select disabled multiple
                                title="Choose at least one age range..." class="selectpicker show-tick border rounded form-control inputBoxFormNewBook "
                                name="ageGroup[]" id="ageGroup" data-width="100%" data-live-search="true"
                                data-actions-box="true">
                            @foreach($ageGroups as $ageGroup)
                                <option @foreach($book->ageGroups as $ageGroupBook) @if($ageGroupBook->id==$ageGroup->id) selected @endif @endforeach class="inputBoxFormNewBook "  value="{{$ageGroup->id}}" >{{$ageGroup->age_group}}</option>
                            @endforeach
                        </select>

                    </div>



                </div>
                <div class="form-row my-2">
                    <div class="col-md-6">
                        <label class="labelBoxFormNewBook" for="author">Authors</label>
                        <select disabled multiple
                                title="Choose at least one author..." class="selectpicker show-tick border rounded form-control inputBoxFormNewBook"
                                name="author[]" id="author" data-width="100%" data-live-search="true" data-actions-box="true">
                            @foreach($authors as $author)
                                <option @foreach($book->authors as $bookAuthor) @if($bookAuthor->id==$author->id) selected @endif @endforeach class="inputBoxFormNewBook "
                                        value="{{$author->id}}">{{$author->name}}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="col-md-6">
                        <label class="labelBoxFormNewBook" for="illustrator">Illustrator</label>
                        <input disabled  type="text" maxlength="50" name="illustrator" id="illustrator" class="inputBoxFormNewBook form-control "  value="{{ $book->illustrator }}"  >

                    </div>
                </div>

                <div class="form-row my-2">


                    <div class="col">
                        <label class="labelBoxFormNewBook" for="summary">Summary</label>
                        <textarea disabled  rows="2" type="text" maxlength="200"
                                  name="summary" id="summary"
                                  class="inputBoxFormNewBook form-control "
                        >{{ $book->summary}}</textarea>

                    </div>
                </div>

                <div class="form-row my-2">

                    <div class="col-md-6">
                        <label class="labelBoxFormNewBook" for="activityType">Activity Themes</label>
                        <select disabled multiple data-width="100%" title="Choose at least one theme..."
                                data-live-search="true"
                                data-actions-box="true"
                                class="selectpicker show-tick border rounded form-control   inputBoxFormNewBook "
                                name="activityType[]" id="activityType">
                            @foreach($activityTypes as $activityType)
                                <option @foreach($book->activityTypes as $bookActivity) @if($bookActivity->id==$activityType->id) selected @endif @endforeach class="inputBoxFormNewBook "
                                        value="{{$activityType->id}}">{{$activityType->type}}</option>
                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6">
                        <label class="labelBoxFormNewBook" for="bookTheme">Book Themes</label>
                        <select disabled required data-width="100%" title="Choose at least one theme..." multiple
                                data-actions-box="true"
                                data-live-search="true"
                                class="selectpicker show-tick border rounded form-control   inputBoxFormNewBook "
                                name="bookTheme[]" id="bookTheme">
                            @foreach($themes as $theme)
                                <option @foreach($book->themes as $bookTheme) @if($bookTheme->id==$theme->id) selected @endif @endforeach class="inputBoxFormNewBook "
                                        value="{{$theme->id}}">{{$theme->name}}</option>
                            @endforeach

                        </select>

                    </div>



                </div>
                <div class="form-row my-2">

                    <div class="col">
                        <label class="labelBoxFormNewBook" for="activity">Activity Description</label>
                        <textarea disabled  rows="2" type="text" maxlength="200"
                                  name="activity" id="activity"
                                  class="inputBoxFormNewBook form-control "
                        >{{ $book->activity }}</textarea>

                    </div>

                </div>
                <div class="form-group text-center">
                    <a href="{{URL::previous()}}"><button class="buttonSubmitFormat show_confirm_editbook mt-4" type="button">Go Back</button></a>
                </div>
            </form>
        </div>


@endsection
@section('scripts')


    <script src="{{asset('js/bootstrap-select.js')}}" defer></script>
@endsection





