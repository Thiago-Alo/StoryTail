@extends('master.main')
@section('styles')


    <link rel="stylesheet" href="{{asset('css/wordle.css')}}">

    <style>

        .wordle-container{

            margin-bottom: -30px !important;

        }

        .keyboard-row{

            margin-bottom: 3px;
        }


         footer{

             display: none;

         }




    </style>

@endsection



@section('content')



    <section class="wordle-container mt-3 " data-wordle="container">
        <div class="wordle">
            <h1 id="title" class="wordle-title"><img src="{{asset('storage/images/login/logo1.png')}}" alt="">  Wordle<img src="{{asset('storage/images/website/raposa4-removebg-preview.png')}}" alt=""></h1>
            <hr>
            <br>
            <div id="board" class="wordle-board">
            </div>
            <br>
            <h1 id="answer" class="wordle-answer"></h1>
        </div>
    </section>

    aud
@endsection




@section('scripts')

    <script src="{{ asset('js/wordle.js') }}" defer></script>


@endsection
