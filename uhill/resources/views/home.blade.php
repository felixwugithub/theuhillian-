@extends('layout')

@section('content')

@auth
<h3 >Welcome {{auth()->user()->name}}</h3>
<p>hello</p>

<form method="POST" action="/logout">
    @csrf
    <button type="submit">Logout</button>
</form>

@else
    <a href="/register">register</a>
    <a href="/login">login</a>
@endauth

<h1>
    Courses at University Hill Secondary:
</h1>


@if(count($courses) == 0)
    <p>No Info</p>
@endif

@foreach($courses as $course)

    <h2>
       <a href="/course/{{$course['id']}}"> {{$course['course_name']}}</a>
    </h2>

    <p>{{$course['description']}}</p>

@endforeach


@endsection



