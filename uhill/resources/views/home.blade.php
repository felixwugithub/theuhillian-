@extends('layout')

@section('content')





<h1>
    Courses at University Hill Secondary:
</h1>

<form action="/filter" method="post" \>

    @csrf

    Order By:
    <select name="sort_by" id="sort_by">
        <option value='overall' <?php if (isset($sort_by) && $sort_by=="overall") echo "selected";?>>Overall Rating</option>
        <option value='personality' <?php if (isset($sort_by) && $sort_by=="personality") echo "selected";?>>Personality</option>
        <option value='fairness' <?php if (isset($sort_by) && $sort_by=="fairness") echo "selected";?>>Fairness</option>
        <option value='easiness' <?php if (isset($sort_by) && $sort_by=="easiness") echo "selected";?>>Easiness</option>
        <option value='review_count' <?php if (isset($sort_by) && $sort_by=="review_count") echo "selected";?>>Number of Reviews</option>

    </select>
    <select name="order" id="order">
        <option value='desc' <?php if (isset($order) && $order=="desc") echo "selected";?>> High-to-low</option>
        <option value='asc' <?php if (isset($order) && $order=="asc") echo "selected";?>> Low-to-high</option>
    </select>
    Search Filter:
    <input type="text" name="search" value="{{session('search')}}">
    <button type="submit">Apply Filter</button>

</form>



@if(count($courses) == 0)
    <p>No Info</p>
@endif


@foreach ($courses as $course)
    <h2>
       <a href="/course/{{$course['id']}}"> {{$course['course_name']}}</a>
        <h3>rating: {{$course['overall']}} / 10</h3>
    </h2>
    <p>{{$course['description']}}</p>

@endforeach
@endsection



