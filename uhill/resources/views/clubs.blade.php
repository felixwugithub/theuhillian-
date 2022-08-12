
@extends('layout')
@section('content')



    <div class="flex font-sf items-center justify-center mx-auto pt-5">
        <h1 class="md:mt-4 pb-5 ml-7 text-notReallyBlack text-5xl md:text-5xl tracking-tight ">
            Clubs at University Hill Secondary
        </h1>
    </div>





    <div class="flex-wrap align-content-center flex justify-center w-full h-full container p-10">
        @foreach ($clubs as $club)
            <div class="w-full md:w-1/4 bg-blue-50 h-96 m-5 rounded-full justify-center pt-10 container text-center">
                <div class="w-48 justify-center mx-auto">
                  <a href="{{route('club', ['club_name' => str_replace(' ', '_',$club->name)])}}" class="text-center mx-auto">{{$club->name}}</a>
                </div>
            </div>
        @endforeach



    </div>

@endsection



