@extends('layout')

@section('content')

    <p>Please tolerate the presently crude user interface, the one guy coding this site really needs some rest.</p>
    <h1 class="text-2xl text-center flex mx-auto">What would you like to do? </h1>

    <a href="/club-magazine-editor/{{$club->id}}">Write a new article</a>

@endsection
