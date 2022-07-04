@extends('master.main')

@section('styles')

   <style>

       footer{

           display: none;

       }

   </style>

@endsection
@section('content')


    <div class="contacto">
        <div class="container-contacto">
            <form method="POST" action="{{route('contact.send')}}">
                @csrf
                <img src='{{asset('storage/images/login/bg3-removebg-preview.png')}}' alt="">
                <div class="contacto-body">
                    <span for="email">Email address</span>
                    <input  style="font-size: 18px" value="{{auth()->user()->email}}"  required readonly name="email" tabindex="1" type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            placeholder="Enter your email">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <span for="name">Name</span>
                    <input style="font-size: 18px" name="name" required readonly value="{{auth()->user()->name}}" type="text" tabindex="2" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" placeholder="Your name">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <span for="message">Message</span>

                    <textarea placeholder="Enter your message..." autofocus required style="font-size: 18px" name="message" tabindex="3" class="form-control @error('message') is-invalid @enderror" id="message" rows="3">{{old('message')}}</textarea>
                    @error('message')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection


