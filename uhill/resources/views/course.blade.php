@extends('layout')

@section('content')


    @if(isset($message))

        <h3 class="text-lg">{{$message}}</h3>

    @endif


<h1>{{$course['course_name']}}</h1>
<h5>Overall rating: {{$course['overall']}} /10</h5>
<a href="../teacher/{{$course->teacher['id']}}">Teacher: {{$course->teacher['name']}}</a>
<p>Summary: {{$course['description']}}</p>


<h5>Personality: {{$course['personality']}}/10</h5>
<h5>Fairness: {{$course['fairness']}}/10 </h5>
<h5>Easiness: {{$course['easiness']}}/10 </h5>


<a href="/course/{{$course['id']}}/review"> Give review </a>

@foreach($course->reviews as $review)

    <div style="background-color: aliceblue">
    <a href="../profile/{{$review->user['id']}}">{{$review->user['username']}}: </a>
    <h5>Personality: {{$review['personality']}}/10</h5>
        <h5>Fairness: {{$review['fairness']}}/10</h5>
        <h5>Easiness: {{$review['easiness']}}/10</h5>

    <h4>{{$review['title']}}</h4>
    <p>{{$review['content']}}</p>
    </div>
<p>Liked by {{$review->reviewHelpfuls()->count()}}</p>
    @if(!$review->reviewHelpfuledBy(auth()->user()))
    <form action="{{route('course', $review->id)}}" method="post" class="mr-1">
        @csrf
        <button type="submit" class="text-blue-500">Helpful</button>
    </form>
    @else
    <form action="{{route('course', $review->id)}}" method="post" class="mr-1">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-blue-500">Unhelpful</button>

    </form>
    @endif

@endforeach

@endsection


