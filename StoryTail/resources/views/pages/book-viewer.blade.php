@extends('master.main-pdf-viewer')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/flip-book/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/flip-book/flip.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/modal-rating.css')}}">



@endsection



@section('content')
    <body>

    <div class="pdf-container">
        <!-- flipbook markup -->

        <div class="pdf-book-itens">
            <a  href="{{route('home')}}"><button id="buttonHome" class="buttonPdfBook " type="button">Home</button></a>
            @if(!empty($book->audio_url))
            <audio controls>
                <source src="{{asset($book->audio_url)}}" type="audio/ogg">
                <source src="{{asset($book->audio_url)}}" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
            @endif
            <a style="display: none" id="buttonFinishRead" href="#" data-last-modal="open"><button class="buttonPdfBook " type="button">Finish Read</button></a>

        </div>


        <div id="flipbook"  style="height:80vh;">

        </div>




        <!-- HTML FINISH MODAL-->
        <section class="container-last-modal" data-last-modal="container">
            <div class="last-modal">
                <h2 class="last-mondal-title text-center">
                    You've finished the book, <br><span>{{$book->title}}</span>, congratulations!
                </h2>
                @if($countRating==0)
                    <p class="textModal">How much did you like this book?
                        Please let us know by leaving a rating below
                    </p>
                @else
                    <p class="textModal">You have already rated this book.
                        Do you want to change your rating?
                    </p>

                @endif

                <form  method="POST" id="formRatingBook">
                    @method('POST')
                    @csrf
                    <img src="{{asset('storage/images/website/raposa2-removebg-preview.png')}}" alt="">
                    <div class="star-radio" >
                        <input class="ratingCheck" @if($rating==5) checked @endif value="5" type="radio" name="rate" required id="rate-5">
                        <label for="rate-5" class="fas fa-star"></label>
                        <input class="ratingCheck" @if($rating==4) checked @endif  value="4" type="radio" name="rate" required  id="rate-4">
                        <label   for="rate-4" class="fas fa-star"></label>
                        <input class="ratingCheck" @if($rating==3) checked @endif value="3" type="radio" name="rate" id="rate-3" required >
                        <label  for="rate-3" class="fas fa-star"></label>
                        <input class="ratingCheck" @if($rating==2) checked @endif  value="2" type="radio" name="rate" required  id="rate-2">
                        <label for="rate-2" class="fas fa-star"></label>
                        <input class="ratingCheck" @if($rating==1) checked @endif  value="1" type="radio" name="rate" required  id="rate-1">
                        <label for="rate-1" class="fas fa-star"></label>
                    </div>

                    @if($countRating>0)

                    <div class="text-center">
                        <button formaction="{{route('books-stats',[$book])}}" class="last-modal-btn-no pr-1" type="submit" >Go to Activity</button>
                        <button formaction="{{route('books-stats-edit-rating',[$book])}}" class="last-modal-btn-newrating" type="submit" {{--data-last-modal="closed"--}}>Submit New Rating</button>

                    </div>


                    @else

                        <div class="text-center">
                            <button formaction="{{route('books-stats',[$book])}}" class="last-modal-btn" type="submit" >Submit</button>
                        </div>
                    @endif

                </form>

            </div>
        </section>

    </div>

<!-- /end flipbook markup -->
@endsection
<!-- scripts-section -->

@section('scripts')


<script type="text/javascript" src="{{asset('js/flip-book/jquery.min.js')}}" defer></script>
<script type="text/javascript" src="{{asset('js/flip-book/pdf.min.js')}}" defer></script>
<script type="text/javascript" src="{{asset('js/flip-book/jquery.kurasa.min.js')}}" defer></script>
<script type="text/javascript" src="{{asset('js/modal-rating.js')}}" defer></script>


<script>
    $(document).ready(function() {
        var options = {
            responsive:true,
            autoFit:true,
            autoHeight: false,



            padding:{
                top:20,
                left:10,
                right:10,
                bottom:70
            },
            //PDF AQUI
            pdfUrl: '{{asset($book->book_url)}}',
            pdfAutoCreatePages: true,
            pdfBookSizeFromDocument: true,

            zoom:1,

            toolbarControls: [
                {type:'share',        active:true},
                {type:'sound',        active:true, optional: false},
                {type:'outline',      active:true},
                {type:'thumbnails',   active:true},
                {type:'gotofirst',    active:true},
                {type:'prev',         active:true},
                {type:'pagenumber',   active:true},
                {type:'next',         active:true},
                {type:'gotolast',     active:true},
                {type:'zoom-in',      active:true, optional: false},
                {type:'zoom-out',     active:true, optional: false},
                {type:'zoom-default', active:true, optional: false},
                {type:'optional',     active:false},
                {type:'download',     active:false, optional: false},
                {type:'fullscreen',   active:true, optional: false},
            ],

            bookmarks: [

                {text:'Front Cover', link:'1'},


            ],
        };

        $('#flipbook').kurasa(options);

        // Events
        $('#flipbook').on('kurasa:ready', function(e, plugin) {
            console.log('event:ready');
        });

        $('#flipbook').on('kurasa:showpage', function(e, plugin, page) {
            console.log('event:showpage [' + page + ']');
            if (page>={{$book->numberPages-2}}){
                /*$('#buttonHome').css('display','block')*/;

                setTimeout(function () {
                    $('#buttonFinishRead').show("slow");
                    $('#buttonHome').hide("slow");

                }, 1000);

            }


        });

        $('#flipbook').on('kurasa:hidepage', function(e, plugin, page) {
            console.log('event:hidepage [' + page + ']');
        });
    });
</script>
<!-- /end scripts-section -->

@endsection
</body>


