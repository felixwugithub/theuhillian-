
@extends('layout')
@section('content')


    <div class="flex font-sf items-center justify-center mx-auto pt-8">
    <h1 class="mt-4 text-notRealBlack text-6xl md:text-4xl tracking-tight">
    Courses at University Hill Secondary
    </h1>
</div>


<div class="flex font-slim text-sm items-center justify-center mx-auto pt-8 mb-8">
    <form action="/filter" method="post" \>
     @csrf


        <label for="sort_by"> Sort By: </label>
        <select name="sort_by" id="sort_by" class="bg-felixSalmon  rounded no-border text-sm focus:ring-hotPink">
        <option value='overall' <?php if (isset($sort_by) && $sort_by=="overall") echo "selected";?>>Overall Rating</option>
        <option value='personality' <?php if (isset($sort_by) && $sort_by=="personality") echo "selected";?>>Personality</option>
        <option value='fairness' <?php if (isset($sort_by) && $sort_by=="fairness") echo "selected";?>>Fairness</option>
        <option value='easiness' <?php if (isset($sort_by) && $sort_by=="easiness") echo "selected";?>>Easiness</option>
        <option value='review_count' <?php if (isset($sort_by) && $sort_by=="review_count") echo "selected";?>>Number of Reviews</option>
        </select>

        <label for="order"> Order by: </label>
        <select name="order" id="order" class="bg-felixSalmon rounded no-border text-sm focus:ring-hotPink">
        <option value='desc' <?php if (isset($order) && $order=="desc") echo "selected";?>> High to Low</option>
        <option value='asc' <?php if (isset($order) && $order=="asc") echo "selected";?>> Low to High</option>
        </select>


        <label for="grade" class="text-sm"> Grade: </label>
        <select name="grade" id="grade" class="bg-felixSalmon rounded no-border text-sm focus:ring-hotPink">
            <option value=13 <?php if (isset($grade) && $grade==13) echo "selected";?>> Any </option>
            <option value=8 <?php if (isset($grade) && $grade==8) echo "selected";?>> 8 </option>
            <option value=9 <?php if (isset($grade) && $grade==9) echo "selected";?>> 9 </option>
            <option value=10 <?php if (isset($grade) && $grade==10) echo "selected";?>> 10 </option>
            <option value=11 <?php if (isset($grade) && $grade==11) echo "selected";?>> 11 </option>
            <option value=12 <?php if (isset($grade) && $grade==12) echo "selected";?>> 12</option>
        </select>


        <label for="search"> Search for: </label>
        <input class="bg-felixSalmon no-border rounded text-sm focus:ring-hotPink" type="text" id="search" name="search" value="{{session('search')}}">

        <button type="submit" class="bg-hotPink text-xs text-white font-slim rounded hover:bg-pink-500 px-0.5 pt-0.5"> Filter</button>

    </form>

</div>


@if($no_results)
    <p class="flex font-sansMid text-xs items-center justify-center mx-auto pt-8">No Results. Check out these courses.</p>
@endif

<div class="flex flex-wrap justify-center">



@foreach ($courses as $course)
    <div class="rounded bg-felixSalmon m-4 max-w-sm">
    <div class="justify-left mx-10 pt-5 items-end">
        <center><a class="font-sf text-2xl"  href="/course/{{$course['id']}}"> {{$course['course_name']}}</a></center>
        <h2>{{$course->teacher->name}}</h2>
        <br>
        <h3 class="font-sans mx-auto text-lg">rating: {{$course['overall']}} / 10</h3>
        <p>Personality rating: {{$course['personality']}} / 10 </p>

    </div>
    <div class="justify-left mx-10 pb-5">
    <p>{{substr($course['description'],0,75)}}...</p>
        <br>

        @if($course['grade'] != 13)
            <p>Grade: {{$course['grade']}}</p>
        @else
            <p> All Grades</p>
        @endif
    </div>

    </div>
@endforeach




</div>



    <div class="flex font-sansMid items-center justify-center mx-auto mb-10">


    @if($paginatePage)
        {{$courses->links()}}
    @endif

    </div>


@endsection



