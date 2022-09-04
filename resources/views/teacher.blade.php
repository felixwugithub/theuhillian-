@extends('layout')

@section('content')

    <h1>{{$teacher['name']}}</h1>


    @foreach($teacher->courses as $teacherCourse)
    <a href="../course/{{$teacherCourse['id']}}">{{$teacherCourse['course_name']}}</a>
    @endforeach

@auth
    @if(auth()->user()->admin == 1)

        <a class="text-pink-400" href="/teacher/{{$teacher['id']}}/assigncourse"> Assign a course </a>

    @endif

@endauth

@endsection
