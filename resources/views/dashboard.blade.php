@extends('layout')

@section('content')

    <!-- drawer init and toggle -->
    <div class="text-center my-5">
        <button class="bg-yellow-300 text-white hover:bg-yellow-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="button" data-drawer-target="notifications-drawer" data-drawer-show="notifications-drawer" aria-controls="notifications-drawer">
            @if(count($user->unreadNotifications) > 0)
                <p>You have {{count($user->unreadNotifications)}} new notifications</p>

            @else
                <p>You have no new notifications.</p>
            @endif
        </button>

    </div>




    <div class="container flex-wrap w-full max-w-screen-x m-auto">


<div>
    <div>



    <!-- drawer component -->
    <div id="notifications-drawer" class="fixed z-50 h-screen overflow-y-auto bg-white w-96 dark:bg-gray-800 mt-20" tabindex="-1" aria-labelledby="drawer-label">

        <button type="button" data-drawer-dismiss="notifications-drawer" aria-controls="notifications-drawer" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Close menu</span>
        </button>

        <div id="notifications" class="overflow-scroll h-full w-full max-w-screen-xl m-5 justify-center ">

            <h1 class="text-2xl mt-4 ml-2">Notifications: </h1>

        @if(count($user->unreadNotifications) > 0)
                <a class="ml-2 text-hotPink" href="/markallasread">Mark All As Read</a>
            @endif


            @foreach($user->notifications as $notification)

                <div class="justify-center w-10/12 md:w-11/12 my-2 ml-2 md:ml-0">
                @if(!isset($notification->read_at))
                    <div class="p-2 bg-green-50">
                        @if($notification->type == 'App\Notifications\NewReview')
                            <a href="{{route('reviewRead', ['id' => $notification->data['course_id'], 'review_id' => $notification->data['review_id'], 'notification_id' => $notification->data['id']])}}">{{$notification->data['body']}}</a>
                        @endif
                    </div>
                @else
                    <div class="p-2 bg-slate-200">
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
    <div class="flex flex-wrap align-content-center justify-center mt-7">

        <h1 class="w-full text-3xl font-sf text-center">Your courses: </h1>

    @foreach($courses as $course)
        <div class="rounded m-4 max-w-sm box-shadow relative h-56 w-75 container bg-subject-{{$course['subject']}} gradient-courses">

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



    <div class="flex-wrap align-content-center flex justify-center w-full h-full container p-10">
        @foreach ($clubs as $club)
            <div class="w-full md:w-1/4 bg-blue-50 h-96 m-5 rounded-full justify-center pt-10 container text-center">
                <div class="w-48 justify-center mx-auto">
                    <a href="{{route('club', ['club_name' => str_replace(' ', '_',$club->name)])}}" class="text-center mx-auto">{{$club->name}}</a>
                </div>
            </div>
        @endforeach

    </div>
</div>
    <script src="/js/parts.js"> </script>

</div>
@endsection


