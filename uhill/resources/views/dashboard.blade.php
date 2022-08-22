@extends('layout')

@section('content')



<div class="container flex-wrap w-full max-w-screen-x ">

    @if(count($user->unreadNotifications) > 0)
        <p>You have {{count($user->unreadNotifications)}} new notifications</p>
    @else
        <p>You have no new notifications.</p>
    @endif

    <button class="items-center text-center bg-orange-100 hover:bg-yellow-300" onclick="showHideDiv('notifications')"> Notifications: </button>
    <div id="notifications" class="overflow-scroll max-h-64 w-full max-w-screen-xl m-5">

        @if(count($user->unreadNotifications) > 0)
            <a href="/markallasread">Mark All As Read</a>
        @endif

        @foreach($user->notifications as $notification)

            @if(!isset($notification->read_at))
            <div class="m-5 p-5 bg-green-50">
                @if($notification->type == 'App\Notifications\NewReview')
                    <a href="{{route('reviewRead', ['id' => $notification->data['course_id'], 'review_id' => $notification->data['review_id'], 'notification_id' => $notification->data['id']])}}">{{$notification->data['body']}}</a>
                    @endif
            </div>
            @else
                <div class="m-5 p-5 bg-slate-200">
                    @if($notification->type == 'App\Notifications\NewReview')
                        <a href="{{route('courseListingReview', ['id' => $notification->data['course_id'], 'review_id' => $notification->data['review_id']])}}">{{$notification->data['body']}}</a>
                    @endif
                </div>
            @endif


        @endforeach



    </div>

<div>
    <div class="flex flex-wrap align-content-center justify-center">
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


