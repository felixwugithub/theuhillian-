@extends('layout')

@section('content')


    <!-- Tab links -->
    @if(session()->get('reviewIndex') !== null && session()->get('simple'))
        <body onload="showFormAndScroll('reviews', {{ session()->get("reviewIndex") }})">
    @elseif(session()->get('returnScrollComment') !== null)
        <body onload="showFormAndScroll('comments', {{ session()->get("scroll") }})">
        <div class="bg-pink-500 text-white text-center"><button onclick="scrollToBottomWithSection({{ session()->get("scroll") }})"> Operation successful. Click to go back to the comment. </button></div>

        @elseif(session()->get('commented') !== null)
            <div class="bg-yellow-500 text-white text-center"><p>Commenting was Successful</p></div>
            <body onload="showForm('comments')">

            @elseif(session()->get('reviewIndex') !== null)

                <body onload="showFormAndScroll('reviews', {{ session()->get("reviewIndex") }})">
                <div class="bg-pink-500 text-white text-center"><button onclick="scrollToBottomWithSection({{ session()->get("reviewIndex") }})"> Operation successful. Click to go back to the review. </button></div>
                @else
                <body onload="showForm('reviews')">
            @endif

    <div id="content">
    @if(isset($message))
        <div class="bg-red-500 text-white text-center mt-5 md:pt-0"><h3 class="text-lg">{{$message}}</h3></div>
    @endif


        <div class="md:flex justify-center pt-5 bg-gradient-to-r from-pinkWhite lg:via-felixSalmon to-felixSalmon lg:to-hotPink">

            <div class="md:w-2/3 md:py-5 md:pl-5 md:px-12 m-5">
                <h1 class="font-sf text-4xl mb-3">{{$course['course_name']}}</h1>
                <p>Summary: {{$course['description']}}</p>
                <a href="../teacher/{{$course->teacher['id']}}">Teacher: {{$course->teacher['name']}}</a>
                <a class="bg-hotPink text-white  w-56 h-14 m-5 text-3xl items-center py-auto font-sf text-center justify-center mx-auto flex rounded-lg" href="/course/{{$course['id']}}/review"> Give review </a>
            </div>

            <div class="w-full md:w-1/3 md:rounded-3xl md:mx-5 md:my-auto p-5 md:text-left container relative space-y-5 text-red-900 font-quicksand-regular">
                <div class="flex items-center justify-content-around container relative">
                    <h5 class="md:flex font-sf text-xl">Overall: {{floor($course['overall']+0.5)}} /10</h5>
                    <img src="/images/star-ratings/{{floor($course['overall']+0.5)}}.png" alt="" class="w-36 h-6 right-0 absolute hidden xl:block">
                </div>

                <div class="flex items-center justify-content-around container relative">
                    <h5 class="flex text-xl">Personality: {{floor($course['personality']+0.5)}}/10</h5>
                    <img src="/images/star-ratings/{{floor($course['personality']+0.5)}}.png" alt="" class="w-36 h-6 right-0 absolute hidden xl:block">
                </div>

                <div class="flex items-center justify-content-around container relative w-full">
                    <h5 class="flex text-xl">Fairness: {{floor($course['fairness']+0.5)}}/10 </h5>
                    <img src="/images/star-ratings/{{floor($course['fairness']+0.5)}}.png" alt="" class="w-36 h-6 right-0 absolute hidden xl:block">
                </div>

                <div class="flex items-center justify-content-around container relative">
                     <h5 class="flex text-xl">Easiness: {{floor($course['easiness']+0.5)}}/10 </h5>
                    <img src="/images/star-ratings/{{floor($course['easiness']+0.5)}}.png" alt="" class="w-36 h-6 right-0 absolute hidden xl:block">
                </div>
            </div>

            @if(!$course->courseJoined(auth()->user()))
            <div class="md:m-auto md:mr-5 flex w-full md:w-auto justify-center">
                <a class="font-readex text-lg" href="{{route('joinCourse', ['id' => $course->id])}}">
                    <div class="rounded-lg hover:bg-pinkWhite">
                            <div class="w-36 h-full m-4">
                             <h1 class="font-sf text-black lg:text-white"> JOIN THIS COURSE </h1>
                            <p class="text-sm text-gray-500 lg:text-gray-200"> You will receive notifications in your dashboard when someone reviews this course. </p>
                            </div>
                    </div>
                </a>
            </div>

            @else
                <div class="md:m-auto md:mr-5 flex w-full md:w-auto justify-center">
                    <a class="font-readex text-lg" href="{{route('quitCourse', ['id' => $course->id])}}">
                        <div class="rounded-lg hover:bg-pinkWhite">
                                <div class="w-36 h-full m-4">
                                    <h1 class="font-sf text-black lg:text-white"> QUIT THIS COURSE </h1>
                                    <p class="text-sm text-gray-500 lg:text-gray-200"> You will no longer receive notifications in your dashboard when someone reviews this course.</p>
                                </div>
                        </div>
                    </a>
                </div>
            @endif
        </div>



    <div class="tab">
        <button class="tablinks" onclick="show(event, 'reviews')"> Reviews </button>
        <button class="tablinks" onclick="show(event, 'comments')"> Comments </button>
    </div>

    <div id="reviews" class="tabcontent">




    @foreach($course->reviews as $review)
        <div class="bg-felixSalmon m-5 p-5 b-5 rounded-3xl relative container w-auto" id="review{{$review->id}}" >
            <h1 class="text-4xl font-semibold">"{{$review['title']}}"</h1>
            <div id="reviewBlock{{$review->id}}">

                <a class="text-gray-500" href="../profile/{{$review->user['id']}}">from user <span class="text-lg text-notRealBlack font-sansMid">{{$review->user['username']}}

                        @if($review['created_at'] != $review['updated_at'])

                            (edited at {{$review['updated_at']}})

                        @else

                            at {{$review['created_at']}}

                        @endif


                        : </span></a>

                <p class="text-xl font-sans mt-3">{{$review['content']}}</p>

            </div>







            <ul class="hidden text-gray-600 font-medium text-center rounded-lg divide-x divide-white sm:flex mt-6 mb-3">
                <li class="w-full text-center">
                    <h5>Personality: {{$review['personality']}}/10</h5>
                    <img src="/images/star-ratings/{{$review['personality']}}.png" alt="" class="w-48 h-8 mx-auto hidden md:block">
                </li>
                <li class="w-full">
                    <h5>Fairness: {{$review['fairness']}}/10</h5>
                    <img src="/images/star-ratings/{{$review['fairness']}}.png" alt="" class="w-48 h-8 mx-auto hidden md:block">
                <li class="w-full">
                    <h5>Easiness: {{$review['easiness']}}/10</h5>
                    <img src="/images/star-ratings/{{$review['easiness']}}.png" alt="" class="w-48 h-8 mx-auto hidden md:block">
                </li>

            </ul>





            @auth
                @if($review->user->id == auth()->id())
                    <button class="items-center text-center" onclick="showFormAndHide('reviewEditForm', 'reviewBlock{{$review->id}}')"> Edit </button>
                    <form action="{{route('reviewDelete', ['review_id' => $review->id])}}">
                        <button type="submit">Delete</button>
                    </form>

                <div class="hidden" id="reviewEditForm">
                    <form action="{{route('reviewUpdate', ['review_id' => $review->id])}}">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label for="title">Review Title</label>
                            <input id="title" type="text" name="title"
                                   value="{{old('title')}}">
                            @error('title')
                            <p>{{$message}}</p>
                            @enderror

                            <label for="personality">Personality</label>
                            <input id="personality" type="number" name="personality"
                                   value="{{old('personality')}}">

                            @error('personality')
                            <p>{{$message}}</p>
                            @enderror

                            <label for="fairness">Fairness</label>
                            <input id="fairness" type="number" name="fairness"
                                   value="{{old('fairness')}}">

                            @error('fairness')
                            <p>{{$message}}</p>
                            @enderror

                            <label for="easiness">Easiness</label>
                            <input id="easiness" type="number" name="easiness"
                                   value="{{old('easiness')}}">

                            @error('easiness')
                            <p>{{$message}}</p>
                            @enderror

                            <label for="content">Detailed review</label>
                            <input id="content" type="text" name="content"
                                   value="{{old('content')}}">

                            @error('content')
                            <p>{{$message}}</p>
                            @enderror
                            <button type="submit">Add Review</button>
                        </div>

                    </form>
                </div>



                @endif

            @endauth


         <p>Found helful by {{$review->reviewHelpfuls()->count()}} others</p>
            @auth
            @if(!$review->reviewHelpfuledBy(auth()->user()))
                <form action="{{route('reviewHelpful', ['review' => $review->id, 'reviewIndex' => 'review'.$review->id ] ) }}" method="post" class="mr-1">@csrf
                    <button type="submit" class="text-hotPink">Helpful</button>
                </form>
            @else
                <form action="{{route('reviewHelpful', ['review' => $review->id, 'reviewIndex' => 'review'.$review->id ])}}" method="post" class="mr-1">
                    @csrf

                    @method('DELETE')
                     <button type="submit" class="text-pink-800">Unhelpful</button>
                 </form>
            @endif
            @endauth
        </div>

    @endforeach

    </div>


    <div id="comments" class="tabcontent bg-felixSalmon justify-center justify-content-center">
        <div class="bg-blue-100 mx-3 w-full flex justify-center mx-auto">
        <button class="items-center text-center" onclick="showForm('commentForm')"> Comment </button>
        </div>
        <div id="commentForm" class="hiddenForm bg-blue-100 mx-3 w-full flex justify-center mx-auto" style="display: none">
            <form action="{{route('courseComment', $course['id'])}}" method="post">
                @method('HEAD')
                @csrf

                @if (Auth::check())
                    <input class='bg-white/30 w-full' type="text" name="content">
                    @error('content')
                    <p>{{$message}}</p>
                    @enderror
                <div>
                    <button type="submit" class="text-blue-500">Submit</button>
                </div>
                @else
                    <h1>YOU MUST BE LOGGED IN TO COMMENt</h1>
                @endif

            </form>
        </div>

        @foreach($course->comments->sortByDesc('created_at') as $comment)

            @if($comment->user == auth()->user())
        <div class="bg-yellow-50 border-4 border-red-100 rounded-pill rounded-5 b-1 p-5 m-1" id="comment{{$comment->id}}">
            @else

                <div class="bg-white rounded-pill m-1 b-3 p-5" id="comment{{$comment->id}}">
                    @endif

                    <a href="/profile/{{$comment->user->id}}"><p class="text-sm">{{$comment->user->username}}:</p></a>
            <p class="text-xl" >{{$comment['content']}}</p>
            <p class="text-sm">{{$comment->created_at}}</p>


            @if(!$comment->commentLikedBy(auth()->user()))
                <form action="{{route('courseCommentLike', ['id' => $comment->id, 'commentIndex' => 'comment'.$comment->id ] ) }}">
                    <button type="submit" >like</button>
                </form>

            @else

                <form action="{{route('courseCommentUnlike', ['id' => $comment->id, 'commentIndex' => 'comment'.$comment->id] ) }}">
                    <button type="submit" >Unlike</button>

                </form>

            @endif
            <p>Liked by {{$comment->commentLikes()->count()}}</p>


        </div>

        @endforeach


    </div>

    <script src="/js/parts.js"> </script>

    </div>

@endsection


