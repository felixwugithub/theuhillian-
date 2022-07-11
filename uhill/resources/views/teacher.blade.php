@extends('layout')

@section('content')

    <h1>{{$teacher['name']}}</h1>
    <h3>Bio: {{$teacher['bio']}}</h3>

    @foreach($courses as $course)
    <p>{{$course['course_name']}}</p>
    @endforeach

@endsection
