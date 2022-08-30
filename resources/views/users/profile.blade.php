@extends('layout')

@section('content')

<div class="items-center bg-felixSalmon">
<div class="p-5 m-5 b-5">

    <div>

        <h1 class="font-ooga"> <span class="font-abcdef">USERNAME:</span> {{$username}}</h1>
    </div>

    <div>
        <h2 class="font-ooga"> <span class="font-abcdef">NAME: </span>{{$name}}</h2>
    </div>

    <div>
        <h2 class="font-ooga"><span class="font-abcdef">DATE JOINED:</span> {{$date_joined}}</h2>
    </div>

    <div>
        <h2 class="font-ooga"> <span class="font-abcdef">DESCRIPTION: </span>{{$description}}</h2>
    </div>

    <div>
        <h2 class="font-ooga"><span class="font-abcdef">GRADE: </span>{{$grade}}</h2>
    </div>

    <div>
        <h2 class="font-ooga"><span class="font-abcdef">WEBSITE: </span> <a class="font-ooga" href="{{$url}}">{{$url}}</a> </h2>
    </div>



</div>
</div>


@auth

    @if(auth()->user()->id == $id)

<a href="/profile/{{auth()->user()->id}}/edit"> Edit Profile</a>

    @endif

@endauth

@endsection
