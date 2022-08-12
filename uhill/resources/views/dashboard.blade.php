@extends('layout')

@section('content')


    <div class="flex flex-wrap align-content-center flex justify-center">
    @foreach($courses as $course)



        <div class="rounded m-4 max-w-sm box-shadow relative h-56 w-75 container bg-subject-{{$course['subject']}} gradient-courses">
            <div>
                <div class="py-3 items-start top-0 flex container justify-center text-center bg-gradient-to-tl from-hotPink-100 via-felixSalmon to-felixSalmon">
                    <div class="container w-75 justify-center text-center">
                        <center><a class="font-sf text-xl justify-center text-center"  href="/course/{{$course['id']}}"> {{substr($course['course_name'], 0, 33)}}</a></center>
                    </div>
                </div>

                <div class="h-5 justify-center w-75 bg-gradient-to-r from-pinkWhite via-hotPink100 to-pinkWhite ml-10 mr-10">
                    <img class="fix w-35 justify-center mx-auto object-center" src="/images/star-ratings/{{floor($course['overall']+0.5)}}.png" alt="Stars">
                </div>

                <div class="justify-content-evenly font-quicksand-slim absolute container w-75 px-10 pt-2">
                    <img class="h-8 w-8 flex absolute bottom-0 right-5" src="/images/subject-images/{{$course['subject']}}.png" alt="">


                    <h2 class="font-quicksand-slim text-center "> {{$course->teacher->name}}</h2>
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


@endsection


