
@extends('layout')
@section('content')






    <div class="flex font-sf items-center justify-center mx-auto pt-8">
    <h1 class="mt-4 text-notRealBlack text-xl md:text-4xl tracking-tight">
    Courses at University Hill Secondary
    </h1>
</div>


<div class="flex font-sansMid text-xs items-center justify-center mx-auto pt-8">
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
        <button type="submit" class="bg-hotPink text-white font-slim rounded hover:bg-pink-500">Apply Filter</button>

    </form>

</div>


@if(count($courses) == 0)
    <p class="flex font-sansMid text-xs items-center justify-center mx-auto pt-8">No Info</p>
@endif


@foreach ($courses as $course)

    <div class="rounded bg-pink-100 p-2 m-2">

    <div class="flex justify-left mx-10 pt-10 items-end">
         <a class="font-sf text-2xl" href="/course/{{$course['id']}}"> {{$course['course_name']}}</a>
        <h3 class="font-sans mx-auto text-lg">rating: {{$course['overall']}} / 10</h3>
    </div>

    <div class="flex justify-left mx-10">

    <p>{{$course['description']}}</p>
    </div>

    </div>
@endforeach

    @if($paginatePage)
        {{$courses->links()}}
    @endif


@endsection



