@extends('layout')

@section('content')

    {{$club['name']}}

    <div>
        @if(!$club->clubJoined(auth()->user()))
            <a href="{{route('joinClub', ['id' => $club->id])}}"> Join this club </a>
        @else
            <a href="{{route('quitClub', ['id' => $club->id])}}"> Quit this club </a>
        @endif
    </div>



@endsection


