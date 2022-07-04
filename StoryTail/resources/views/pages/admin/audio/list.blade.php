@extends('master.main_admin')

@section('styles')
   {{-- <link rel="stylesheet" href="{{asset('css/mdb.min.css')}}">--}}

@endsection

@section('content-admin')


    <div class="container mt-5">

        <div class="row">

            <div class="col-12 text-center my-auto">


                <h2 class="my-auto">LIST OF AUDIOS</h2>
                <hr>
            </div>

        </div>

        <div class="row mt-2 ">

            <div class="col-md-12 col-lg-6 justify-content-center justify-content-lg-start  d-flex    ">

                <form class="d-flex align-items-center" action="{{route('audio.list')}}" method="get">
                    <div class="items-nav SearchBox ">

                        <ul class=" my-auto">
                            <li class="search-icon  ">
                                <input style="font-size: 18px" class="my-auto " name="search" type="search"
                                       placeholder="Find an audio by book title...">
                                <span><button class="btn"></button></span>

                            </li>
                        </ul>
                    </div>

                </form>
            </div>

            <div class=" col-md-12 col-lg-6 text-center text-lg-right pt-3 pt-lg-0  my-auto " style="font-size: 20px">
                <span>Number of records:</span>
                <span class="">{{$books->count()}}</span>

            </div>

        </div>

        <div class="row mt-3">
            <div class="col">
                <div class="table-responsive-xl">
                    <table class="table table-striped table-bordered table-hover">

                        <colgroup>
                            <col span="1" style="width: 80%;">
                            <col span="1" style="width: 20%;">


                        </colgroup>


                        <thead>
                        <tr class="mx-auto text-center">

                            <th class="align-middle "  style="font-size: x-large" scope="col">Book Title</th>
                            <th class="align-middle"   style="font-size: x-large" scope="col">Delete Audio</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)


                                <tr  class="mx-auto text-center w-100">
                                    <td class=" align-middle"   style="font-size: larger" >{{$book['title']}}</td>


                                    <td class=" align-middle" >

                                        <div class="d-flex align-items-center justify-content-center">

                                            <form  action="{{route('audio.delete',[$book])}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="deleteBookButton ">

                                        <a title='delete' type="submit" class="show_confirm_deleteaudio">
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





