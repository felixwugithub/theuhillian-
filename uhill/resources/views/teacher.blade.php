@extends('layout')

@section('content')

    <h1>{{$teacher['name']}}</h1>
    <h3>Bio: {{$teacher['bio']}}</h3>

    @foreach($teacherCourses as $teacherCourse)
    <a href="../course/{{$teacherCourse['id']}}">{{$teacherCourse['course_name']}}</a>
    @endforeach



@endsection
