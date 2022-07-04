@extends('master.main_admin')

@section('styles')
<style>
    @media (min-width: 1200px) {
        .container{
            max-width: 1450px;
        }
    }


</style>

@endsection


@section('content-admin')


    <div class="container mt-5 px-4 py-3 customBoxShadowAdminHome  ">

        <div class="row mt-3 ">
            <div class="col d-none d-lg-block">


                <div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel" style="height: 610px">

                    <!--Controls-->
                    <div class="controls-top text-center mb-3">
                        <a class="btn-floating" href="#multi-item-example" data-slide="prev"><i class="fa-solid fa-circle-left mx-2 iconsCarouselAdmin" ></i></a>
                        <a class="btn-floating" href="#multi-item-example" data-slide="next"><i class="fa-solid fa-circle-right mx-2 iconsCarouselAdmin" ></i></a>
                    </div>
                    <!--/.Controls-->

                    <!--Indicators-->

                    <div class="carousel-indicators " >
                        @php
                            $i=0;
                        @endphp
                        @foreach($books as $book)

                            @if($loop->first)

                                <li data-target="#multi-item-example" data-slide-to="{{0}}" class="active " style="background-color: #E95A0C"></li>
                                @php
                                    $i=$i+1
                                @endphp

                            @endif
                            @if((($loop->iteration)-1)%4==0&&!$loop->first)

                                <li data-target="#multi-item-example" data-slide-to="{{$i}}" style="background-color: #E95A0C"></li>
                                    @php
                                        $i=$i+1
                                    @endphp
                            @endif



                        @endforeach
                    </div>

                    <!--/.Indicators-->


                    <!--Slides-->
                    <div class="carousel-inner" role="listbox">

                        <!--First slide-->

                        @foreach($books as $book)

                            @if($loop->first)


                                <div class="carousel-item active ">
                                    <div class="row">
                                        @endif
                                        @if((($loop->iteration)-1)%4==0&&!$loop->first)

                                            <div class="carousel-item">

                                                <div class="row">

                                                    @endif

                                                    <div class="col-md-3">
                                                        <div class="card mb-2">
                                                            <div class="coverBookParentClassAdmin">
                                                                <div class="coverBookBoxCardAdmin" >
                                                                    <embed class="coverBookAdmin "   src="{{asset("$book->cover#toolbar=0")}}">
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <h4 class="card-title text-center " >{{Str::limit($book->title,20)}}</h4>
                                                                <p class="card-text text-center p-0 m-0">@if($book->authors->count()>1)
                                                                        Authors: @else Author:  @endif

                                                                    @foreach($book->authors as $bookAuthor)
                                                                        @if($loop->iteration<=1)
                                                                            @if(!$loop->first)<span>,</span>@endif

                                                                            {{$bookAuthor->name}}
                                                                        @endif
                                                                        @if($loop->iteration==2)
                                                                            <span>...</span>
                                                                        @endif

                                                                    @endforeach</p>
                                                                <p class="p-0 mb-3 mt-2 text-center"><span class=" pr-2 text-center">{{'No. readings : '.$book->users()->wherePivot('book_id', $book->id)->count()}}</span>

                                                                    <span class="text-center pl-2 " >
                                                                       {{-- @for($i = 0; $i < $averageRatingByBook[0][$loop->iteration-1]; $i++)
                                                                            <i class="fa-solid fa-star " style="color: #fd4;font-size: 1.2rem"></i>
                                                                        @endfor--}}

                                                                        @for($i = 0; $i < $book->averageRating; $i++)
                                                                            <i class="fa-solid fa-star " style="color: #fd4;font-size: 1.2rem"></i>
                                                                        @endfor

                                                                        @for($stars=0; $stars < (5-$book->averageRating); $stars++)
                                                                            <label for="rate-5" class="fas fa-star" style="font-size: 1.2rem;color: #444"></label>
                                                                        @endfor


                                                                    </span>

                                                                </p>

                                                                <div class="text-center mt-2">

                                                                    <a href="{{route('books.edit',[$book])}}" class="btn btn-primary buttonCarouselAdmin text-center">Edit Book</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    @if(($loop->iteration)%4==0&&!$loop->first)
                                                    </div>
                                                    </div>
                                        @else
                                        @if($loop->last)
                                            </div>
                                            </div>
                                        @endif
                                        @endif

                                        @endforeach

                                    </div>
                                </div>

            </div>

                </div>

                <hr class="mt-4 mb-5">

        <div class="row mt-3 ">
            <div class="col-lg-6 col-xl-3 my-2">
                <div class="table-responsive-xl">
                    <table class="table table-striped table-bordered table-hover table-sm">
                        <caption class="text-center border tableTitleFormat">Activity Themes</caption>
                        <colgroup>
                            <col span="1" style="width: 15%;">
                            <col span="1" style="width: 5%;">
                        </colgroup>

                        <thead>
                        <tr class="mx-auto text-center">
                            <th class="align-middle " style="font-size: 20px; " scope="col">Name</th>
                            <th class="align-middle" style="font-size: 20px;" scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($activityTypes as $activityType)
                            <tr class="mx-auto text-center w-100">
                                <td class=" align-middle"
                                    style="font-size: larger;"> {{Str::of($activityType['type'])->words(2)}}</td>

                                <td class=" align-middle" style="font-size: larger;">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="editTableAdminButton ">
                                            <span class="toolTipEditTableAdmin ">Edit Row</span>
                                            <a href="{{route('activity-type.edit',[$activityType])}}"><i
                                                    class="  bi bi-pencil-square text-info mr-1"
                                                    style="font-size: 1.5rem"></i></a>
                                        </div>
                                        <form action="{{route('activity-type.delete',[$activityType])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="deleteTableAdminButton ">
                                                <span class="toolTipDeleteTableAdmin">Delete Row</span>
                                                <a data-toggle="tooltip" title='delete' type="submit"
                                                   class="show_confirm_itemAdminHome">
                                                    <i class=" ml-1 bi bi-trash-fill text-danger"
                                                       style="font-size: 1.5rem"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex">
                        {{ $activityTypes->links() }}
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3 my-2">

                <div class="table-responsive-xl">
                    <table class="table table-striped table-bordered table-hover table-sm ">
                        <caption class="text-center border tableTitleFormat">Age Groups</caption>
                        <colgroup>
                            <col span="1" style="width: 15%;">
                            <col span="1" style="width: 5%;">
                        </colgroup>

                        <thead>
                        <tr class="mx-auto text-center">
                            <th class="align-middle " style="font-size: 20px;" scope="col">Age Range</th>
                            <th class="align-middle" style="font-size: 20px;" scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ageGroups as $ageGroup)
                            <tr class="mx-auto text-center w-100">
                                <td class=" align-middle" style="font-size: larger;"> {{$ageGroup['age_group']}}</td>

                                <td class=" align-middle" style="font-size: larger;">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="editTableAdminButton ">
                                            <span class="toolTipEditTableAdmin ">Edit Row</span>
                                            <a href="{{route('age-range.edit',[$ageGroup])}}"><i
                                                    class="  bi bi-pencil-square text-info mr-1"
                                                    style="font-size: 1.5rem"></i></a>
                                        </div>
                                        <form action="{{route('age-range.delete',[$ageGroup])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="deleteTableAdminButton ">
                                                <span class="toolTipDeleteTableAdmin">Delete Row</span>
                                                <a data-toggle="tooltip" title='delete' type="submit"
                                                   class="show_confirm_itemAdminHome">
                                                    <i class=" ml-1 bi bi-trash-fill text-danger"
                                                       style="font-size: 1.5rem"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class=" d-flex ">
                    {{--    {{ $ageGroups->links() }}--}}

                    </div>

                </div>

            </div>

            <div class="col-lg-6  col-xl-3 my-2">

                <div class="table-responsive-xl">
                    <table class="table table-striped table-bordered table-hover table-sm">
                        <caption class="text-center border tableTitleFormat">Authors</caption>
                        <colgroup>
                            <col span="1" style="width: 15%;">
                            <col span="1" style="width: 5%;">
                        </colgroup>

                        <thead>
                        <tr class="mx-auto text-center">
                            <th class="align-middle " style="font-size: 20px;" scope="col">Name</th>
                            <th class="align-middle" style="font-size: 20px;" scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($authors as $author)
                            <tr class="mx-auto text-center w-100">
                                <td class="align-middle"
                                    style="font-size: larger;"> {{Str::of($author['name'])->words(2)}}</td>

                                <td class=" align-middle" style="font-size: larger;">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="editTableAdminButton ">
                                            <span class="toolTipEditTableAdmin ">Edit Row</span>
                                            <a href="{{route('author.edit',[$author])}}"><i
                                                    class="  bi bi-pencil-square text-info mr-1"
                                                    style="font-size: 1.5rem"></i></a>
                                        </div>
                                        <form action="{{route('author.delete',[$author])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="deleteTableAdminButton ">
                                                <span class="toolTipDeleteTableAdmin">Delete Row</span>
                                                <a data-toggle="tooltip" title='delete' type="submit"
                                                   class="show_confirm_itemAdminHome">
                                                    <i class=" ml-1 bi bi-trash-fill text-danger"
                                                       style="font-size: 1.5rem"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class=" d-flex ">

                        {{ $authors->links() }}

                    </div>

                </div>


            </div>

            <div class="col-lg-6 col-xl-3 my-2">

                <div class="table-responsive-xl">
                    <table class="table table-striped table-bordered table-hover table-sm">
                        <caption class="text-center border tableTitleFormat">Book Themes</caption>
                        <colgroup>
                            <col span="1" style="width: 15%;">
                            <col span="1" style="width: 5%;">
                        </colgroup>

                        <thead>
                        <tr class="mx-auto text-center">
                            <th class="align-middle " style="font-size: 20px;" scope="col">Theme</th>
                            <th class="align-middle" style="font-size: 20px;" scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($themes as $theme)
                            <tr class="mx-auto text-center w-100">
                                <td class=" align-middle"
                                    style="font-size: larger;"> {{Str::of($theme['name'])->words(2)}}</td>

                                <td class=" align-middle" style="font-size: larger;">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="editTableAdminButton ">
                                            <span class="toolTipEditTableAdmin ">Edit Row</span>
                                            <a href="{{route('book-theme.edit',[$theme])}}"><i
                                                    class="  bi bi-pencil-square text-info mr-1"
                                                    style="font-size: 1.5rem"></i></a>
                                        </div>
                                        <form action="{{route('book-theme.delete',[$theme])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="deleteTableAdminButton ">
                                                <span class="toolTipDeleteTableAdmin">Delete Row</span>
                                                <a data-toggle="tooltip" title='delete' type="submit"
                                                   class="show_confirm_itemAdminHome">
                                                    <i class=" ml-1 bi bi-trash-fill text-danger"
                                                       style="font-size: 1.5rem"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex ">

                        {{ $themes->links() }}

                    </div>

                </div>

            </div>
        </div>


                        </div>


@endsection

@section('scripts')

    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/alert_dialog.js') }}"></script>


@endsection



