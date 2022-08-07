@extends('layout')

@section('content')

<div class="items-center bg-felixSalmon">
<div class="p-5 m-5 b-5">

    <div>
        <h1>username: </h1> <h1>{{$username}}</h1>
    </div>

    <div>
        <h2>name: </h2> <h2>{{$name}}</h2>
    </div>

    <div>
        <p>date joined: </p> <p>{{$date_joined}}</p>
    </div>

    <div>
        <p> description: </p> <p>{{$description}}</p>
    </div>

    <div>
        <p>grade: </p> <p>{{$grade}}</p>
    </div>

    <div><p>Website: </p> <a href="{{$url}}">{{$url}}</a></div>



</div>
</div>


@auth

    @if(auth()->user()->id == $id)

<a href="/profile/{{auth()->user()->id}}/edit"> Edit Profile</a>

    @endif

@endauth

@endsection
