
@extends('layout')
@section('content')


    <div class="bg-white">



    <div class="flex font-sf items-center justify-center mx-auto pt-5 space-x-2">
        <h1 class="md:mt-4 pb-5 ml-7 text-center text-notReallyBlack text-5xl ">Courses</h1>
        <h1 class="md:mt-4 pb-5 ml-7 text-center text-notReallyBlack text-5xl hidden md:block ">at University Hill Secondary
        </h1>
    </div>

        @if(session()->get('request_success'))
            <div class="bg-pinkie">
                <p class="text-spicyPink text-lg font-comfortaa px-3 py-0.5 text-center m-5 rounded-xl">your course request will be reviewed by an admin soon.</p>
            </div>
        @endif

<div class="md:flex font-slim text-lg  md:justify-center md:mx-auto md:pt-8 md:mb-3">
    <form action="/filter" method="post" \>
        <div class="md:flex font-slim text-sm items-center  mx-auto md:pt-8 md:mb-8 pt-2 px-6 left">
     @csrf
        <div class="pt-2 justify-start ml-2">
             <label for="sort_by"> Sort By: </label>
            <select name="sort_by" id="sort_by" class="bg-felixSalmon  rounded no-border text-sm focus:ring-hotPink absolute right-3 md:relative md:right-0 w-36">
                 <option value='overall' <?php if (isset($sort_by) && $sort_by=="overall") echo "selected";?>>Overall Rating</option>
                 <option value='personality' <?php if (isset($sort_by) && $sort_by=="personality") echo "selected";?>>Personality</option>
                 <option value='fairness' <?php if (isset($sort_by) && $sort_by=="fairness") echo "selected";?>>Fairness</option>
                <option value='content_coverage' <?php if (isset($sort_by) && $sort_by=="content_coverage") echo "selected";?>>Content Coverage</option>
                <option value='difficulty' <?php if (isset($sort_by) && $sort_by=="difficulty") echo "selected";?>>Difficulty</option>
                <option value='review_count' <?php if (isset($sort_by) && $sort_by=="review_count") echo "selected";?>>Number of Reviews</option>
            </select>
        </div>

            <br>
        <div class="pt-2 justify-start ml-2">
        <label for="order"> Order by: </label>
             <select name="order" id="order" class="bg-felixSalmon rounded no-border text-sm focus:ring-hotPink absolute right-3 md:relative md:right-0 w-36">
                 <option value='desc' <?php if (isset($order) && $order=="desc") echo "selected";?>> High to Low</option>
                 <option value='asc' <?php if (isset($order) && $order=="asc") echo "selected";?>> Low to High</option>
             </select>

        </div>
            <br>
        <div class="pt-2 justify-start ml-2">
          <label for="grade" class="text-sm"> Grade: </label>
             <select name="grade" id="grade" class="bg-felixSalmon rounded no-border text-sm focus:ring-hotPink absolute right-3 md:relative md:right-0 w-36">
                 <option value=13 <?php if (isset($grade) && $grade==13) echo "selected";?>> Any </option>
                 <option value=8 <?php if (isset($grade) && $grade==8) echo "selected";?>> 8 </option>
                 <option value=9 <?php if (isset($grade) && $grade==9) echo "selected";?>> 9 </option>
                 <option value=10 <?php if (isset($grade) && $grade==10) echo "selected";?>> 10 </option>
                 <option value=11 <?php if (isset($grade) && $grade==11) echo "selected";?>> 11 </option>
                 <option value=12 <?php if (isset($grade) && $grade==12) echo "selected";?>> 12</option>
             </select>
        </div>
            <br>
            <div class="pt-2 justify-start ml-2">
                <label for="subject" class="text-sm"> Subject: </label>
                <select name="subject" id="subject" class="bg-felixSalmon rounded no-border text-sm focus:ring-hotPink absolute right-3 md:relative md:right-0 w-36">
                    <option value="all" <?php if (isset($subject) && $subject=="all") echo "selected";?> >All</option>
                    <option value="art" <?php if (isset($subject) && $subject=="art") echo "selected";?> >Visual Arts 2D/3D/Yearbook</option>
                    <option value="biology" <?php if (isset($subject) && $subject=="biology") echo "selected";?>>Biology</option>
                    <option value="career" <?php if (isset($subject) && $subject=="career") echo "selected";?>>Career</option>
                    <option value="chemistry" <?php if (isset($subject) && $subject=="chemistry") echo "selected";?>> Chemistry</option>
                    <option value="community" <?php if (isset($subject) && $subject=="community") echo "selected";?>>Community</option>
                    <option value="computers" <?php if (isset($subject) && $subject=="computers") echo "selected";?>>Computers</option>
                    <option value="economics" <?php if (isset($subject) && $subject=="economics") echo "selected";?>>Economics/Business/Finance</option>
                    <option value="engineering" <?php if (isset($subject) && $subject=="engineering") echo "selected";?>>Engineering</option>
                    <option value="english" <?php if (isset($subject) && $subject=="english") echo "selected";?>>English</option>
                    <option value="foods" <?php if (isset($subject) && $subject=="foods") echo "selected";?>>Foods</option>
                    <option value="languages" <?php if (isset($subject) && $subject=="languages") echo "selected";?>>Second Languages</option>
                    <option value="math" <?php if (isset($subject) && $subject=="math") echo "selected";?>>Math</option>
                    <option value="PE" <?php if (isset($subject) && $subject=="PE") echo "selected";?>>PE/Active Living</option>
                    <option value="physics" <?php if (isset($subject) && $subject=="physics") echo "selected";?>>Physics</option>
                    <option value="science" <?php if (isset($subject) && $subject=="science") echo "selected";?>>Science (Grade 10 and under)</option>
                    <option value="socials" <?php if (isset($subject) && $subject=="socials") echo "selected";?>>Social/Political Sciences | History/Geography</option>
                    <option value="skills" <?php if (isset($subject) && $subject=="skills") echo "selected";?>>Skills</option>
                    <option value="statistics" <?php if (isset($subject) && $subject=="statistics") echo "selected";?>>Statistics</option>
                    <option value="theatre" <?php if (isset($subject) && $subject=="theatre") echo "selected";?>>Theatre</option>
                </select>
            </div>
            <br>
        <div class="pt-2 justify-start ml-2">

        <label for="search"> Search for: </label>
        <input placeholder="leave blank for all" class="placeholder-hotPink bg-felixSalmon no-border rounded text-sm focus:ring-hotPink absolute right-3 md:relative md:right-0" type="text" id="search" name="search" value="{{session('search')}}">

        </div>
            <br>
            <div class="pt-2 text-center justify-start ml-2">
        <button type="submit" class="bg-hotPink text-xs text-white font-slim rounded hover:bg-pink-500 md:px-1 md:text-sm special p-14 md:py-1 text-xl "> Filter</button>
            </div>

        </div>

    </form>

</div>

    <div class="flex justify-center mx-auto text-center items-center font-ooga text-sm mt-5">
        <p>Can't find your course? Request to <a class="text-hotPink hover:border-2" href="/course-request">add a course</a> to our catalogue.</p>
    </div>


@if($courses->count() == 0)
    <p class="flex font-sansMid text-xs items-center justify-center mx-auto pt-8">No Results. Check out these courses.</p>
@endif

<div class="flex flex-wrap align-content-center flex justify-center">
@foreach ($courses as $course)


    <div onclick="window.location.href = '/course/{{$course->id}}';" class="rounded m-4 max-w-sm box-shadow relative h-56 w-75 container bg-subject-{{$course['subject']}} gradient-courses hover:shadow-xl">
        <div>
            <div class="py-3 items-start top-0 flex container justify-center text-center bg-gradient-to-tl from-hotPink-100 via-felixSalmon to-felixSalmon">
                <div class="container w-75 justify-center text-center">
                <center><a class="font-sf text-xl justify-center text-center"  href="/course/{{$course['id']}}"> {{substr($course['course_name'], 0, 33)}}</a></center>
                </div>
            </div>

            <div class="h-5 justify-center w-75 bg-gradient-to-r from-pinkWhite via-hotPink100 to-pinkWhite ml-10 mr-10">
                <img class="fix w-35 justify-center mx-auto object-center" src="/images/star-ratings/{{floor($course['overall'] + 0.5)}}.png" alt="Stars">
            </div>

            <div class="justify-content-evenly font-quicksand-slim absolute container w-75 px-10 pt-2">
                <img class="h-8 w-8 flex absolute bottom-0 right-5" src="/images/subject-images/{{$course['subject']}}.png" alt="">


                <h2 class="font-quicksand-slim text-center "> {{$course->teacher->name}}</h2>


                <div class="absolute bottom-[5px] justify-center items-center text-center pl-[6rem] text-xs">
                @if(isset($sort_by))
                    @if($sort_by !== 'overall' && $sort_by !== 'review_count')
                        <p class="text-hotPink ">{{$sort_by}}: {{floor($course[$sort_by] + 0.5)}} / 10</p>
                    @elseif($sort_by == 'review_count')
                        <p class="text-hotPink ">Number of reviews: {{floor($course[$sort_by] + 0.5)}}</p>
                    @endif
                @endif
                </div>


                <p class="font-slim">{{substr($course['description'],0,64)}}...</p>

                <br>


                @if($course['grade'] != 13)
                    <p>Grade: {{$course['grade']}}</p>
                @else
                    <p> All Grades</p>
                @endif
            </div>
        </div>
    </div>


@endforeach




</div>



    <div class="flex font-sansMid items-center justify-center mx-auto mb-10">


    @if($paginatePage)
        {{$courses->links()}}
    @endif
    </div>


    </div>
@endsection



