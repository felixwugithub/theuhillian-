@extends('layout')

@section('content')



@auth
<h3 >Welcome {{auth()->user()->name}}</h3>

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

<form action="/courses" method="post" \>

    @csrf
    <button type="submit" value="Submit">sort by: </button>
    <select name="sort_by" id="sort_by">
        <option value=""></option>
        <option value='overall'> Best Overall Rating </option>
        <option value='personality'> Best Personality </option>
        <option value='fairness'> Best Fairness </option>
        <option value='easiness'> Best Easiness  </option>
    </select>
    <select name="order" id="order">
        <option value=  ></option>
        <option value=1 > High-to-low</option>
        <option value=0> Low-to-high</option>

    </select>



</form>



@if(count($courses) == 0)
    <p>No Info</p>
@endif



<p>currently sorting by: {{$sort_by}}, {{$order}}</p>


@if($order == 1)
@foreach ($courses->sortByDesc($sort_by) as $course)

    <!-- REPEATED CODE 1A> </!-->
    <h2>
       <a href="/course/{{$course['id']}}"> {{$course['course_name']}}</a>
        <h3>rating: {{$course['overall']}} / 10</h3>
    </h2>
    <p>{{$course['description']}}</p>


@endforeach

@elseif($order == 0)
    @foreach ($courses->sortBy($sort_by) as $course)

        <!-- REPEATED CODE 1A> </!-->
        <h2>
            <a href="/course/{{$course['id']}}"> {{$course['course_name']}}</a>
            <h3>rating: {{$course['overall']}} / 10</h3>
        </h2>
        <p>{{$course['description']}}</p>
    @endforeach

@endif




@endsection



