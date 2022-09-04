@extends('layout')

@section('content')

    <aside class="fixed right-0 top-0 p-5 z-50 mt-24 text-2xs md:text-sm bg-slate-100 bg-opacity-40 font-comfortaa rounded-l-lg text-hotPink">

        <div>
            <ul class="space-y-12 text-center">
                <li>
                    <button onclick="document.getElementById('courses').scrollIntoView()">Your<br>Courses</button>
                </li>

                <li>
                    <button onclick="document.getElementById('clubs').scrollIntoView()">Your<br>Clubs</button>
                </li>
            </ul>
        </div>

    </aside>

    <!-- drawer init and toggle -->
    <main class="text-center mb-5 mt-12">

        <button class="bg-slate-200 text-white hover:bg-green-200 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="button" data-drawer-target="notifications-drawer" data-drawer-show="notifications-drawer" aria-controls="notifications-drawer">
            @if(count($user->unreadNotifications) > 0)

                <div class="flex container relative p-1">
                    <p class="text-2xs top-0.5 right-0.5 absolute bg-spicyPink rounded-full h-5 w-5">{{count($user->unreadNotifications)}}</p>
                    <img class="w-10" src="/images/icons/colorbell.png" alt="">
                </div>

            @else
                <div class="flex container relative p-1">
                <p class="text-2xs top-0.5 right-0.5 absolute"> </p>
                <img class="w-10" src="/images/icons/blackbell.png" alt="">
                </div>


                @endif
        </button>

    </main>




    <div class="container flex-wrap w-full max-w-screen-x m-auto">


<div class="md:pr-14">
    <div>



    <!-- drawer component -->
    <div id="notifications-drawer" class="fixed z-50 h-screen overflow-y-auto bg-white w-full mt-20" tabindex="-1" aria-labelledby="drawer-label">

        <button type="button" data-drawer-dismiss="notifications-drawer" aria-controls="notifications-drawer" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Close menu</span>
        </button>

        <div id="notifications" class="overflow-scroll h-full w-11/12 max-w-screen-xl mx-auto justify-center ">

            <h1 class="text-2xl mt-4 mx-auto text-center w-full font-comfortaa">Notifications: </h1>

        @if(count($user->unreadNotifications) > 0)
                <a class="mx-auto text-hotPink text-center" href="/markallasread">Mark All As Read</a>
            @endif


            @foreach($user->notifications as $notification)

                <div class="justify-center w-10/12 md:w-11/12 my-2 mx-auto md:ml-0">
                @if(!isset($notification->read_at))
                    <div class="p-2 bg-pinkie font-ooga rounded-lg">
                        @if($notification->type == 'App\Notifications\NewReview')
                            <a href="{{route('reviewRead', ['id' => $notification->data['course_id'], 'review_id' => $notification->data['review_id'], 'notification_id' => $notification->data['id']])}}">{{$notification->data['body']}}</a>
                        @endif
                    </div>
                @else
                    <div class="p-2 bg-slate-200 font-slim rounded-2xl">
                        @if($notification->type == 'App\Notifications\NewReview')
                            <a href="{{route('courseListingReview', ['id' => $notification->data['course_id'], 'review_id' => $notification->data['review_id']])}}">{{$notification->data['body']}}</a>
                        @endif
                    </div>
                @endif
                </div>

            @endforeach

        </div>

    </div>

    </div>




    <div class="flex flex-wrap align-content-center justify-center mt-7" id="courses">

    @foreach($courses as $course)
        <div onclick="window.location.href = '/course/{{$course->id}}';" class="rounded m-4 max-w-sm box-shadow relative h-56 w-75 container bg-subject-{{$course['subject']}} gradient-courses">

            @if(in_array($course->id, $unread_course_ids))
                <img class="w-3 h-3 flex absolute top-3 right-3" src="images/icons/red-dot.svg" alt="new activity">
            @endif
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

    <div class="flex-wrap flex" id="clubs">
        @foreach ($clubs as $club)
            <a href="{{route('club', ['club_name' => str_replace(' ', '_',$club->name)])}}" class="text-center mx-auto">
                <div class="text-veryDarkBlue w-11/12 h-96 m-3 rounded-3xl box-shadow hover:shadow-2xl  justify-center pt-10 container relative text-center md:w-[22rem] bg-blue-50 bg-opacity-50 rounded drop-shadow-xl items-center">
                    @if(isset($club->club_cover_image))
                        <div class="m-auto flex justify-center items-center container top-2 relative">
                            <img class="overflow-hidden w-full h-[122px] object-cover" src="{{'storage/clubCoverImages/'.$club->club_cover_image->image}}" alt="image">
                        </div>
                    @endif

                    <div class="justify-center mt-5 px-3">
                        <h1 class="font-bold text-2xl">{{$club->name}}</h1>
                        @if(isset($club->description))
                            <h2 class="pt-3 font-readex">{{substr($club->description, 0, 75)}}...</h2>
                        @endif
                    </div>


                    <div class="absolute bottom-0 cen text-center mx-auto flex mb-5 justify-center items-center items-center justify-content-around space-x-5 left-1/2 transform -translate-x-1/2">
                        @if(isset($club->room_number))
                            <h2 class="pt-3 font-slim ">Room: <span class="font-readex">{{substr($club->room_number, 0, 10)}}</span></h2>
                        @endif

                        @if(isset($club->meeting_times))
                            <h2 class="pt-3 font-slim ">Day of week: <span class="font-readex">{{substr($club->meeting_times, 0, 20)}}</span></h2>
                        @endif
                    </div>

                </div>
            </a>
        @endforeach

    </div>



</div>
    <script src="/js/parts.js"> </script>

</div>
@endsection


