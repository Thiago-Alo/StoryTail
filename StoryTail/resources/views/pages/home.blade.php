@extends('master.main')

@section('styles')

    <style>


        @media screen and (min-width: 1800px){
            .container-fluid {
                width:80%; !important;

            }
        }





    </style>


@endsection

@section('content')

<div class="wrapper"></div>

<div class="container-gallery">
    <img src="{{asset('storage/images/website/logo-removebg-preview.png')}}" alt="">
    <div class="items">
        <div class="d-flex flex-row flex-wrap justify-content-center align-items-center ">
        <img src="{{asset('storage/images/website/raposa2-removebg-preview.png')}}" alt="">

        <form action="{{route('home')}}" method="get">
        <button  class="btn m-0 p-0 buttonAge"  type="submit"><span class="item @if(Request::get('age-range')===null&&Request::get('search')===null) active @endif btn" >All</span></button>


        @foreach($ageGroups as $ageGroup)

       <button class="btn m-0 p-0 buttonAge" name="age-range" type="submit" value="{{$ageGroup->getRawOriginal('age_group')}}" ><span class="item btn @if(Request::get('age-range')===$ageGroup->getRawOriginal('age_group')) active @endif">{{str_replace(' ','',$ageGroup->age_group)}}</span></button>

        @endforeach
        </form>
        <span><img src="{{asset('storage/images/website/raposa4-removebg-preview.png')}}" alt=""></span>
        </div>
    </div>
</div>
<!-- filter books-->
<div class="gallery container-fluid mt-3 ">
    <!--Inicio do card-->
    @php
        $j=0;
    @endphp

    @foreach($books as $book)
    <div class="box-card" data-name="X">
        @php
            $j=$j+1;
        @endphp

        <div class="card front-face"  >
            <embed   src="{{asset("$book->cover#toolbar=0")}}">

        </div>

        <div class="card back-face">
            <div class="info">
                <div class="title">{{Str::limit(strtoupper($book->title),25)}}</div>
                <div class="book-author">@if($book->authors->count()>1)
                        Authors: @else Author:  @endif

                    @foreach($book->authors as $bookAuthor)
                        @if($loop->iteration<=1)
                            @if(!$loop->first)<span>,</span>@endif

                            {{$bookAuthor->name}}
                        @endif
                        @if($loop->iteration==2)
                            <span>...</span>
                        @endif

                    @endforeach</div>
                <div class="star-radio mt-3">


                    @for($stars=0; $stars < (5-$book->averageRating); $stars++)
                        <label for="rate-5" class="fas fa-star"></label>
                    @endfor


                    @for($i = 0; $i < $book->averageRating; $i++)
                        {{--<input type="radio" name="rate" id="rate-5">--}}
                        <label for="rate-5" class="fas fa-star" style=" color: #fd4;"></label>

                    @endfor


                </div>

                <form class="" action="{{route('user-favourite',[$book])}}"
                      method="POST">
                    @csrf
                    @method('PUT')

                    @if(auth()->user()->books()->wherePivot('book_id', $book->id)->wherePivot('is_favourite', true)->count()>0)


                        <button  name="userFavourite" value="false" class=" userFavouriteButton btn m-0 p-0 "
                                type="submit"  ><i
                                class=" buttonFavouriteYes m-0 p-0 bi bi-heart-fill"
                                style="font-size: 1.8rem"></i></button>
                    @else
                <button name="userFavourite" value="true" class="btn userFavouriteButton  m-0 p-0 "
                        type="submit"  ><i
                        class="buttonFavouriteNo m-0 p-0 bi bi-heart-fill"
                        style="font-size: 1.8rem"></i></button>

                    @endif

                </form>

                <div class="description my-2" >
                    <a data-modal="{{'abrir'.$j}}" href="#">Description</a>
                </div>




                <a class="readme" href="{{route('books-read',[$book])}}">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    READ ME</a>




            </div>
        </div>
    </div>



@endforeach
    <!--Fim do card-->

</div>

<div class="row mt-4">
    <div class="col d-flex ">

        {{ $books->links() }}

    </div>
</div>



@php
    $y=0;
@endphp

@foreach($books as $book)
    @php
        $y=$y+1;
    @endphp

<section class="modal-container" data-modal="{{'container'.$y}}">
    <div class="modal">
        <button data-modal="{{'fechar'.$y}}" class="fechar">X</button>
        <div class="modal-description" data-modal="{{'description'.$y}}">
            <div class="modal-title">
                {{strtoupper($book->title)}}</div>
            <div class="modal-book-author pb-2 ">
                @if($book->authors->count()>1)
                    <b>Authors:</b> @else <b>Author:</b>  @endif

                @foreach($book->authors as $bookAuthor)

                        @if(!$loop->first)<span>,</span>@endif

                        {{$bookAuthor->name}}

                @endforeach

                 <br><b>Age Range:</b>

                    @php
                        $ageGroupArray=array();
                    @endphp


                    @foreach ($book->ageGroups as $ageGroupBook)
                        @php
                            $ageGroupArray[]=$ageGroupBook->age_group;
                        @endphp
                    @endforeach
                    @php
                        sort($ageGroupArray,SORT_NUMERIC);

                    @endphp

            @foreach($ageGroupArray as $ageGroupBookOrderBy)

                         @if(!$loop->first)<span>,</span>@endif

                {{$ageGroupBookOrderBy}}

            @endforeach
                 <br><b>Themes:</b>
                        @foreach($book->themes as $bookTheme)
                            @if(!$loop->first)<span>,</span>@endif
                            {{$bookTheme->name}}
                        @endforeach
                    <br><i class="fa-solid fa-book-open mr-1" style="margin-left: 2px"></i>{{$book->numberPages.' pages'}}
                    @if(!empty($book->audio_url))
                        <span><i class=" fa-solid fa-file-audio ml-1 "></i></span>
                    @endif

                    <br><span class="">@for($i = 0; $i < $book->averageRating; $i++)
                        {{--<input type="radio" name="rate" id="rate-5">--}}
                        <label for="rate-5" class="fas fa-star" style=" color: #fd4;"></label>
                    @endfor
                    @for($stars=0; $stars < (5-$book->averageRating); $stars++)
                        <label for="rate-5" class="fas fa-star"></label>
                    @endfor
                        <span class="ml-1">No. of reviews: {{$book->users()->wherePivot('book_id',$book->id)->wherePivotNotNull('rating')->count()}}</span>
                </span>
            </div>
            </div>
            <div class="text-description mt-2" style="border-bottom: 2px solid #E95A0C;">
                <p><b>Summary:</b> {{$book->summary}} </p>
            </div>

        @if(!empty($book->activity))


            <div class="d-flex flex-row mt-2 align-items-center">


            @foreach($book->activityTypes as $bookActivities)

                    <div class="activityIcon ">
                        <span class="toolTipActivity" >{{$bookActivities->type}}</span>
               <img  class="img-fluid mt-2 mx-1" style="width: 24px;height: auto;filter: invert(43%) sepia(75%) saturate(3136%) hue-rotate(358deg) brightness(94%) contrast(95%);" src="{{asset($bookActivities->activity_image)}}" alt="">
                    </div>
                        @endforeach
            </div>
        <div class="text-description mt-2 ">
            <p><b>Activity:</b> {{$book->activity}} </p>
        </div>
        @endif
        <div class="text-center mt-4">
        <a class="readme_modal" href="{{route('books-read',[$book])}}">

            READ ME</a>
        </div>
        </div>


</section>


@endforeach




@endsection

@php
    $z=0;
@endphp


@section('scripts')

    @foreach($books as $book)

        @php
            $z=$z+1;
        @endphp

    <script defer>
        function initModal() {
            const botaoAbrir = document.querySelector('[data-modal="{{'abrir'.$z}}"]');
            const botaoFechar = document.querySelector('[data-modal="{{'fechar'.$z}}"]');
            const containerModal = document.querySelector('[data-modal="{{'container'.$z}}"]');

            if(botaoAbrir && botaoFechar && containerModal) {

                function toggleModal(event) {
                    event.preventDefault();
                    containerModal.classList.toggle('ativo');
                }
                function cliqueForaModal(event) {
                    if(event.target === this) {
                        toggleModal(event);
                    }
                }

                botaoAbrir.addEventListener('click', toggleModal);
                botaoFechar.addEventListener('click', toggleModal);
                containerModal.addEventListener('click', cliqueForaModal);
            }
        }
        initModal()
    </script>





    @endforeach

@endsection
