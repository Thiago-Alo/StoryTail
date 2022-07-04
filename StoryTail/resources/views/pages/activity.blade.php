@extends('master.main-pdf-viewer')

@section('styles')


<link rel="stylesheet" href="{{ asset('css/activity.css') }}" >
    <style>

        main{

            background-color: rgba(255, 165, 0,0.3);

        }

    </style>

@endsection
@section('content')

    <div class="container d-flex justify-content-center align-items-center " style="height: 100vh;width: 100vw;"  >

        <div class="last mx-auto my-auto ">
            <h1 class="last-title">
                Activity
            </h1>

            <div class="d-flex flex-row mt-2 align-items-center">


                @foreach($book->activityTypes as $bookActivities)


                    <div class="activityIcon ">
                        <span class="toolTipActivity" >{{$bookActivities->type}}</span>
                        <img  class="img-fluid mt-2 mx-1" style="width: 40px;height: auto;filter: invert(43%) sepia(75%) saturate(3136%) hue-rotate(358deg) brightness(94%) contrast(95%);" src="{{asset($bookActivities->activity_image)}}" alt="">
                    </div>
                @endforeach
            </div>
            <p class="mt-3">
                {{$book->activity}}
            </p>
            <img class="mt-2" src="{{asset('storage/images/website/raposa2-removebg-preview.png')}}" alt="">

            <a class="btn" role="button" href="{{route('home')}}" value="Back To Home">Back to Home</a>

        </div>

    </div>



@endsection


