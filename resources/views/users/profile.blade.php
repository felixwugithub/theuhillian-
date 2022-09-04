@extends('layout')

@section('content')

<div class="items-center bg-pinkie text-2xl flex justify-center">
<div class="p-5 m-5 b-5 space-y-5 mx-auto">

    <div class="text-center">
         <h1>{{$username}}</h1>
    </div>

    <div>
        <h2 class="font-ooga"> <span class="font-abcdef">name: </span>{{$name}}</h2>
    </div>

    <div>
        <h2 class="font-ooga"><span class="font-abcdef">date joined:</span> {{$date_joined}}</h2>
    </div>

    <div>
        <h2 class="font-ooga"> <span class="font-abcdef">bio: </span>{{$description}}</h2>
    </div>

    <div>
        <h2 class="font-ooga"><span class="font-abcdef">grade: </span>{{$grade}}</h2>
    </div>

    <div>
        <h2 class="font-ooga"><span class="font-abcdef">url: </span> <a class="font-ooga" href="{{$url}}">{{$url}}</a> </h2>
    </div>

    <div>
    @auth

        @if(auth()->user()->id == $id)

            <a href="/profile/{{auth()->user()->id}}/edit" class="text-sm font-comfortaa text-hotPink"> Edit Profile</a>

        @endif

    @endauth

    </div>



</div>

</div>
@endsection


