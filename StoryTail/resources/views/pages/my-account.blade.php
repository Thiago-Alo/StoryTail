@extends('master.main')
@section('styles')

    <link rel="stylesheet" href="{{asset('css/my-account.css')}}">
    <link rel="stylesheet" href="{{asset('css/filepond.css')}}">
    <link rel="stylesheet" href="{{asset('css/filepond_preview.css')}}">

@endsection

@section('content')


<br>
<form  method="POST" id="formEditUser"  action="{{route('my-account-update',[auth()->user()->id])}}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="container">

        <div class="main">
            <div class="topbar">
                <h2>My Account</h2>
            </div>
            <div class="row">
                <div class="col-md-3 mt-1 ">
                    <div class="card text-center sidebar ">
                        <div class="card-body">
                            @if(!empty(auth()->user()->photo))
                            <div id="currentPhoto" class="text-center">
                            <img  src="{{asset(auth()->user()->photo)}}" class="rounded-circle" width="180" />
                            </div>
                            @endif
                            <div class="mt-3">
                                <h3>{{Auth()->user()->name}}</h3>

                                <hr>

                                <div id="editPhoto" style="display: none">
                                <input  form="formEditUser" type="file"  name="userImage" value="{{ old('userImage') }}" id="userImage" class="filepond border rounded  @error('userImage') is-invalid @enderror"  >
                                @error('userImage')
                                <span class="inputBoxFormNewBook invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
                                @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 mt-1">

                    <div class="card mb-3content">
                        <div class="row">
                        <div class="col-md-3 my-auto ">
                        <h1 class="m-3 pt-3">About</h1>
                        </div>
                            <div class="col-md-9 d-flex  align-items-center justify-content-center ">
                                <button id="buttonEdit" class="buttonEditMyAccount  " type="button">EDIT</button>
                                <button id="buttonGoBack" class="btn buttonGoBackMyAccount mx-2 " style="display: none" type="button" ><i class=" fa-solid fa-arrow-rotate-left" style="color: white" ></i></button>
                                <button id="buttonSubmit" class="buttonEditMyAccount show_confirm_edituser  "  type="submit" style="display: none">SUBMIT</button>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3 my-auto ">
                                    <h5 class="m-0">Full Name</h5>
                                </div>
                                <div class="col-md-9 text-secondary my-auto">
                                    <input style="font-size: 17px" class="form-control  @error('name') is-invalid @enderror" disabled type="text" name="name" id="name" placeholder="Enter your first and last name" required
                                           autocomplete="name" autofocus maxlength="50" value="{{Auth()->user()->name}}">
                                    @error('name')
                                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong></span>
                                    @enderror

                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-3 my-auto">
                                    <h5 class="m-0">Date of Birth</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <input style="font-size: 17px" disabled onfocus="(this.type='date')" class="form-control @error('age') is-invalid @enderror" type="text" name="age"
                                           id="age" value="{{ Auth()->user()->getRawOriginal('age') }}" placeholder="Enter your date of birth" required
                                    >

                                </div>
                                @error('age')
                                <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-3 my-auto">
                                    <h5 class="m-0">Email</h5>
                                </div>
                                <div class="col-md-9 text-secondary" style="font-size: 17px">{{Auth()->user()->email}}</div>
                            </div>
                            <hr />

                            <div class="row">
                                <div class="col-md-3 my-auto">
                                    <h5 class="m-0">Last Book read</h5>
                                </div>

                            <div class="col-md-9 text-secondary" style="font-size: 17px">{{$userLastBookRead}}</div>
                        </div>

                    </div>
</form>
                    <div class="card mb-3content">
                        <h1 class="m-3">Favourite Books</h1>
                        <div class="card-body">

                            <div class="row">

                                <div class="col d-flex flex-wrap justify-content-center  ">
                                    @foreach($userFavouritesBooks as $userFavouritesBook)


                                        <form id="userFavourite" class="" action=""
                                              method="POST">

                                            @csrf
                                            @method('PUT')

                                      <div class="container text-center" >
                                    <div class="coverBookParentClassMyAccount ">
                                        <div class="coverBookBoxCardMyAccount" >

                                            <embed class="coverBookMyAccount"   src="{{asset("$userFavouritesBook->cover#toolbar=0")}}">

                                            <div class="text-center">
                                                <button formaction="{{route('user-favourite',[$userFavouritesBook])}}" id="buttonFavourite" name="userFavourite" value="false" class="btn m-0 p-0  "
                                                        type="submit"  ><i
                                                        class=" m-0 p-0  buttonFavouriteYes bi bi-heart-fill"
                                                        style="font-size: 1.5rem"></i></button>
                                            <a class="text-center " href="{{route('books-read',[$userFavouritesBook])}}">Read me Again</a>
                                            </div>

                                        </div>
                                    </div>
                                      </div>
                                        </form>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    </div>




@endsection

@section('scripts')
    <script defer>
        jQuery("button[id=buttonEdit]").click(function(){
            jQuery("input[name=name],input[name=age]").attr("disabled",false);
            $("#buttonEdit").css("display", "none");
            $("#buttonSubmit").css("display", "block");
            $("#buttonGoBack").css("display", "block");
            $("#currentPhoto").hide("slow");
            $("#editPhoto").show("slow");



        });


        jQuery("button[id=buttonGoBack]").click(function(){
            jQuery("input[name=name],input[name=age]").attr("disabled",true);
            $("#buttonSubmit").css("display", "none");
            $("#currentPhoto").show("slow");
            $("#editPhoto").hide("slow");
            $("#buttonGoBack").css("display", "none");
            $("#buttonEdit").css("display", "block");


        });

    </script>

            <script src="{{ asset('js/sweetalert.min.js') }}"></script>
            <script src="{{ asset('js/alert_dialog.js') }}"></script>


            <script src="{{ asset('js/filepond_script.js') }}"></script>
            <script src="{{ asset('js/filepond_validation.js') }}"></script>
            <script src="{{ asset('js/filepond_preview.js') }}"></script>

            <script>
                FilePond.registerPlugin(FilePondPluginFileValidateType);
                FilePond.registerPlugin(FilePondPluginImagePreview);
                const inputElement = document.querySelector('input[id="userImage"]');
                const pond = FilePond.create(inputElement,{
                        labelIdle: `Drag & Drop your image file or <span class="filepond--label-action"> Browse </span>`,
                        acceptedFileTypes: ['image/*'],
                        credits: '',


                        server:
                            {
                                url:'../upload-image-user',
                                headers: {
                                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                                }

                            }



                    }

                );


            </script>

@endsection
