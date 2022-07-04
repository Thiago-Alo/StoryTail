@extends('master.main_admin')

@section('content-admin')


    <div class="container mt-5">


        <div class="row">

            <div class="col-12 text-center my-auto">


                <h2 class="my-auto">LIST OF USERS</h2>
                <hr>
            </div>

        </div>

        <div class="row mt-2 ">

            <div class="col-md-12 col-lg-4 justify-content-center justify-content-lg-start  d-flex  ">


                <form class="d-flex align-items-center" action="{{route('users.list')}}" method="get">
                    <div class="items-nav SearchBox ">

                        <ul class=" my-auto">
                            <li class="search-icon  ">
                                <input style="font-size: 18px" class="my-auto " name="search" type="search"
                                       placeholder="Find a student by name or email...">
                                <span><button class="btn"></button></span>

                            </li>
                        </ul>
                    </div>

                </form>
            </div>

            <div class="col-6 col-lg-4 text-left text-lg-center pt-3 pt-lg-0  my-auto  " style="font-size: 20px">
                <span>Number of records:</span>
                <span class="">{{$users->count()}}</span>

            </div>


            <div class="col-6 col-lg-4 pt-3 pt-lg-0 d-flex justify-content-end  " >


                <form action="{{route('users.list')}}" method="get">

                    <div class="btn-group float-right">
                        <button style="font-size: 20px" type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                            Order by
                        </button>
                        <div class="dropdown-menu">
                            <button style="font-size: larger" name="orderby" value="age_DESC" type="submit"
                                    class="btn dropdown-item  @if(Request::get('orderby')==='age_DESC')active font-weight-bold @endif ">
                                Age (Asc)
                            </button>
                            <button style="font-size: larger" name="orderby" value="age_ASC" type="submit"
                                    class="btn dropdown-item  @if(Request::get('orderby')==='age_ASC')active  font-weight-bold @endif ">
                                Age (Desc)
                            </button>
                            <button style="font-size: larger" name="orderby" value="active_DESC" type="submit"
                                    class="btn dropdown-item  @if(Request::get('orderby')==='active_DESC')active font-weight-bold @endif ">
                                Active
                            </button>
                            <button style="font-size: larger" name="orderby" value="active_ASC" type="submit"
                                    class="btn dropdown-item  @if(Request::get('orderby')==='active_ASC')active font-weight-bold @endif ">
                                Inactive
                            </button>
                            <button style="font-size: larger" name="orderby" value="email_ASC" type="submit"
                                    class="btn dropdown-item  @if(Request::get('orderby')==='email_ASC')active font-weight-bold @endif ">
                                Email (Asc)
                            </button>
                            <button style="font-size: larger" name="orderby" value="email_DESC" type="submit"
                                    class="btn dropdown-item  @if(Request::get('orderby')==='email_DESC')active font-weight-bold @endif ">
                                Email (Desc)
                            </button>
                            <button style="font-size: larger" name="orderby" value="email_verified_at_ASC" type="submit"
                                    class="btn dropdown-item @if(Request::get('orderby')==='email_verified_at_ASC')active font-weight-bold @endif  ">
                                E-mail verified (Asc)
                            </button>
                            <button style="font-size: larger" name="orderby" value="email_verified_at_DESC"
                                    type="submit"
                                    class="btn dropdown-item @if(Request::get('orderby')==='email_verified_at_DESC')active font-weight-bold @endif  ">
                                E-mail verified (Desc)
                            </button>
                            <button style="font-size: larger" name="orderby" value="last_login_at_ASC" type="submit"
                                    class="btn dropdown-item @if(Request::get('orderby')==='last_login_at_ASC')active font-weight-bold @endif  ">
                                Last login (Asc)
                            </button>
                            <button style="font-size: larger" name="orderby" value="last_login_at_DESC" type="submit"
                                    class="btn dropdown-item @if(Request::get('orderby')==='last_login_at_DESC')active font-weight-bold @endif  ">
                                Last Login (Desc)
                            </button>
                            <button style="font-size: larger" name="orderby" value="name_ASC" type="submit"
                                    class="btn dropdown-item @if(Request::get('orderby')==='name_ASC')active font-weight-bold @endif ">
                                Name (Asc)
                            </button>
                            <button style="font-size: larger" name="orderby" value="name_DESC" type="submit"
                                    class="btn dropdown-item @if(Request::get('orderby')==='name_DESC')active font-weight-bold @endif ">
                                Name (Desc)
                            </button>
                        </div>

                    </div>
                </form>
            </div>


        </div>


        <div class="row mt-3">
            <div class="col">
                <div class="table-responsive-xl">
                    <table class="table table-striped table-bordered table-hover">

                        <colgroup>
                            <col span="1" style="width: 15%;">
                            <col span="1" style="width: 5%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 15%;">
                            <col span="1" style="width: 15%;">
                            <col span="1" style="width: 5%;">
                            <col span="1" style="width: 5%;">
                            <col span="1" style="width: 5%;">

                        </colgroup>


                        <thead>
                        <tr class="mx-auto text-center">

                            <th class="align-middle " style="font-size: x-large" scope="col">Name</th>
                            <th class="align-middle" style="font-size: x-large" scope="col">Age</th>
                            <th class="align-middle" style="font-size: x-large" scope="col">E-mail</th>
                            <th class="align-middle" style="font-size: x-large" scope="col">E-mail verified</th>
                            <th class="align-middle" style="font-size: x-large" scope="col">Last login</th>
                            <th class="align-middle" style="font-size: x-large" scope="col">Active</th>
                            <th class="align-middle" style="font-size: x-large" scope="col">Role</th>
                            <th class="align-middle" style="font-size: x-large" scope="col">Delete</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)

                            @if((auth()->user()->id)!=($user->id))
                                <tr class="mx-auto text-center w-100">
                                    <td class=" align-middle" style="font-size: larger">{{$user['name']}}</td>
                                    <td class=" align-middle" style="font-size: larger">{{$user['age']}}</td>
                                    <td class=" align-middle" style="font-size: larger">{{$user['email']}}</td>
                                    <td class="align-middle "
                                        style="font-size: larger">{{$user['email_verified_at']}}</td>

                                    <td class="align-middle " style="font-size: larger">{{$user['last_login_at']}}</td>


                                    <form class="d-inline-block" action="{{route('users.update.active',[$user->id])}}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')

                                        @if($user['active']==1)
                                            <td class="align-middle  @error('active') is-invalid @enderror"
                                                style="font-size: larger">
                                                <button class=" btn" type="submit" name="active" value="0"><i
                                                        class=" @error('active') is-invalid @enderror bi bi-emoji-smile-fill text-success  my-auto "
                                                        style="font-size: 1.8rem"></i></button>
                                            </td>
                                        @else
                                            <td class="align-middle  @error('active') is-invalid @enderror"
                                                style="font-size: larger">
                                                <button class="btn " type="submit" name="active" value="1"><i
                                                        class=" @error('active') is-invalid @enderror bi bi-emoji-frown-fill text-danger  my-auto "
                                                        style="font-size: 1.8rem"></i></button>
                                            </td>
                                        @endif
                                        @error('active')
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                                </span>
                                        @enderror

                                    </form>

                                    <td class="align-middle "
                                        style="font-size: larger">
                                    <form  class="d-inline-block" action="{{route('users.update.role',[$user->id])}}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')

                                        @if($user['account_type_id']==2)

                                                <div class="studentButton ">
                                                    <span class="toolTipStudent ">Student</span>

                                                    <input name="userType" type="hidden" value="1">
                                                    <button class="btn show_confirm_role  @error('userType') is-invalid @enderror"
                                                            type="submit"   ><i
                                                            class=" @error('userType') is-invalid @enderror fa-solid fa-user-graduate text-info  my-auto "
                                                            style="font-size: 1.8rem"></i></button>

                                                    @error('userType')
                                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                                </span>
                                                    @enderror
                                                </div>

                                        @else

                                                <div class="adminButton ">
                                                    <span class="toolTipAdmin ">Admin</span>
                                                    <input name="userType" type="hidden" value="2">
                                                    <button class="btn show_confirm_role @error('userType') is-invalid @enderror "
                                                            type="submit"   ><i
                                                            class=" @error('userType') is-invalid @enderror fa-solid fa-user-tie my-auto "
                                                            style="font-size: 1.8rem"></i></button>
                                                    @error('userType')
                                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                                </span>
                                                    @enderror

                                                </div>
                                        @endif
                                    </form>
                                    </td>
                                    <td class="align-middle " style="font-size: larger">
                                        <form class="d-inline-block" action="{{route('users.delete',[$user->id])}}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn show_confirm" data-toggle="tooltip" title='delete'
                                                    type="submit"><i class="bi bi-trash-fill text-danger  my-auto "
                                                                     style="font-size: 1.8rem"></i></button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col d-flex ">

                {{ $users->links() }}

            </div>
        </div>

    </div>


@endsection
@section('scripts')

    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/alert_dialog.js') }}"></script>



@endsection


