@extends('master.main_admin')

@section('styles')
   {{-- <link rel="stylesheet" href="{{asset('css/mdb.min.css')}}">--}}

@endsection

@section('content-admin')




    <div class="container mt-5">

        <div class="row">

            <div class="col-12 text-center my-auto">


                <h2 class="my-auto">LIST OF BOOKS</h2>
                <hr>
            </div>

        </div>

        <div class="row mt-2 ">

            <div class="col-md-12 col-lg-4 justify-content-center justify-content-lg-start  d-flex    ">

                <form class="d-flex align-items-center" action="{{route('books.list')}}" method="get">
                    <div class="items-nav SearchBox ">

                        <ul class=" my-auto">
                            <li class="search-icon  ">
                                <input style="font-size: 18px" class="my-auto " name="search" type="search"
                                       placeholder="Find a book by author or title...">
                                <span><button class="btn"></button></span>

                            </li>
                        </ul>
                    </div>

                </form>
            </div>

            <div class=" col-6 col-lg-4 text-left text-lg-center pt-3 pt-lg-0  my-auto " style="font-size: 20px">
                <span>Number of records:</span>
                <span class="">{{$books->count()}}</span>

            </div>

            <div class="col-6 col-lg-4 pt-3 pt-lg-0 d-flex justify-content-end " >

                <form action="{{route('books.list')}}" method="get">

                    <div class="btn-group float-right ">
                        <button style="font-size: 20px" type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                            Order by
                        </button>
                        <div class="dropdown-menu">

                            <button style="font-size: larger" name="orderby" value="created_at_ASC" type="submit"
                                    class="btn dropdown-item  @if(Request::get('orderby')==='created_at_ASC')active font-weight-bold @endif ">
                                Data Created (Asc)
                            </button>
                            <button style="font-size: larger" name="orderby" value="created_at_DESC" type="submit"
                                    class="btn dropdown-item  @if(Request::get('orderby')==='created_at_DESC')active font-weight-bold @endif ">
                                Data Created (Desc)
                            </button>

                            <button style="font-size: larger" name="orderby" value="title_ASC" type="submit"
                                    class="btn dropdown-item  @if(Request::get('orderby')==='title_ASC')active font-weight-bold @endif ">
                                Title (Asc)
                            </button>
                            <button style="font-size: larger" name="orderby" value="title_DESC" type="submit"
                                    class="btn dropdown-item  @if(Request::get('orderby')==='title_DESC')active  font-weight-bold @endif ">
                                Title (Desc)
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
                            <col span="1" style="width: 30%;">
                            <col span="1" style="width: 13%;">
                            <col span="1" style="width: 10%;">
                            <col span="1" style="width: 7%;">
                            <col span="1" style="width: 10%;">

                        </colgroup>


                        <thead>
                        <tr class="mx-auto text-center">

                            <th class="align-middle "  style="font-size: x-large" scope="col">Title</th>
                            <th class="align-middle"   style="font-size: x-large" scope="col">Summary</th>
                            <th class="align-middle"   style="font-size: x-large" scope="col">Authors</th>
                            <th class="align-middle"   style="font-size: x-large" scope="col">Themes</th>
                            <th class="align-middle"   style="font-size: x-large" scope="col">Age</th>
                            <th class="align-middle"   style="font-size: x-large" scope="col">Actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)


                                <tr  class="mx-auto text-center w-100">
                                    <td class=" align-middle"   style="font-size: larger" >{{$book['title']}}</td>
                                    <td class=" align-middle"   style="font-size: larger" >{{Str::limit($book['summary'],50)}}</td>
                                    <td class=" align-middle"  style="font-size: larger">
                                        @foreach($book->authors as $bookAuthor)


                                        {{$bookAuthor->name}}<br>

                                        @endforeach

                                    </td>
                                    <td class=" align-middle"  style="font-size: larger">
                                        @foreach($book->themes as $booktheme)

                                            {{$booktheme->name}}<br>

                                        @endforeach


                                        </td>
                                    <td class=" align-middle"  style="font-size: larger">
                                        @foreach($book->ageGroups as $ageGroupBook)

                                        {{$ageGroupBook->age_group}}<br>

                                        @endforeach
                                    </td>
                                    <td class=" align-middle" >

                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="showBookButton">
                                                <span class="toolTipShowBook" >Show Book</span>

                                                <a  href="{{route('books.show',[$book])}}"><i class="  bi bi-eye-fill text-success mr-1"
                                                                                              style="font-size: 1.8rem"></i></a>

                                            </div>

                                            <div class="editBookButton ">
                                                <span class="toolTipEditBook " >Edit Book</span>

                                            <a  href="{{route('books.edit',[$book])}}"><i class="  bi bi-pencil-square text-info mx-2"
                                                                                         style="font-size: 1.8rem"></i></a>

                                            </div>


                                            <form  action="{{route('books.delete',[$book])}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="deleteBookButton ">
                                                <span class="toolTipDeleteBook " >Delete Book</span>
                                        <a data-toggle="tooltip" title='delete' type="submit" class="show_confirm_deletebook">
                                            <i class=" ml-1 bi bi-trash-fill text-danger" style="font-size: 1.8rem"></i></a>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col d-flex ">

                {{ $books->links() }}

            </div>
        </div>

    </div>
@endsection
@section('scripts')


    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/alert_dialog.js') }}"></script>


@endsection





