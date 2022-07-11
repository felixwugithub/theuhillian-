@extends('layout')

@section('content')

    @foreach($teachers as $teacher)
        <h2>
            <a href="/teacher/{{$teacher['id']}}"> {{$teacher['name']}}</a>
        </h2>
    @endforeach

@endsection
