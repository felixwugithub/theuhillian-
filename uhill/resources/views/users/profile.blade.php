@extends('layout')

@section('content')



<h1>
    {{$username}}
</h1>

<h2>{{$name}}</h2>

<p>{{$date_joined}}</p>

<p>{{$description}}</p>

<p>{{$grade}}</p>

<a href="{{$url}}">{{$url}}</a>


@auth

    @if(auth()->user()->id == $id)

<a href="/profile/{{auth()->user()->id}}/edit"> Edit Profile</a>

    @endif

@endauth

@endsection
