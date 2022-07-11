@extends('layout')

@section('content')

<h1>{{$course['course_name']}}</h1>
<h5>Overall rating: {{$course['overall']}} /10</h5>
<h3>Teacher: {{$course['teacher_name']}}</h3>
<p>Summary: {{$course['description']}}</p>


<h5>Personality: {{$course['personality']}}/10</h5>
<h5>Fairness: {{$course['fairness']}}/10 </h5>
<h5>Easiness: {{$course['easiness']}}/10 </h5>


<a href="/course/{{$course['id']}}/review"> Give review </a>

@foreach($course->reviews as $review)

    <div style="background-color: aliceblue">
    <p>{{$review->user['name']}}: </p>
    <h5>Personality: {{$review['personality']}}/10</h5>
        <h5>Fairness: {{$review['fairness']}}/10</h5>
        <h5>Easiness: {{$review['easiness']}}/10</h5>

    <h4>{{$review['title']}}</h4>
    <p>{{$review['content']}}</p>
    </div>

@endforeach

@endsection


