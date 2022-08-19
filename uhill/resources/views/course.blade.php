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
        <div class="bg-red-500 text-white text-center"><h3 class="text-lg">{{$message}}</h3></div>
    @endif

        <h1>{{$course['course_name']}}</h1>
        <h5>Overall rating: {{floor($course['overall']+0.5)}} /10</h5>
        <a href="../teacher/{{$course->teacher['id']}}">Teacher: {{$course->teacher['name']}}</a>
        <p>Summary: {{$course['description']}}</p>


        <h5>Personality: {{$course['personality']}}/10</h5>
        <h5>Fairness: {{$course['fairness']}}/10 </h5>
        <h5>Easiness: {{$course['easiness']}}/10 </h5>


        <div>
            @if(!$course->courseJoined(auth()->user()))
            <a href="{{route('joinCourse', ['id' => $course->id])}}"> Join this course </a>
            @else
                <a href="{{route('quitCourse', ['id' => $course->id])}}"> Quit this course </a>
            @endif
        </div>



    <div class="tab">
        <button class="tablinks" onclick="show(event, 'reviews')"> Reviews </button>
        <button class="tablinks" onclick="show(event, 'comments')"> Comments </button>
    </div>

    <div id="reviews" class="tabcontent">
        <a class="bg-pink-300" href="/course/{{$course['id']}}/review"> Give review </a>
    @foreach($course->reviews as $review)
        <div class="bg-blue-50 m-5 b-5 border-4 border-green-500" id="review{{$review->id}}">

            <div id="reviewBlock{{$review->id}}">

             <a href="../profile/{{$review->user['id']}}">{{$review->user['username']}}: </a>
            <h5>Personality: {{$review['personality']}}/10</h5>
            <h5>Fairness: {{$review['fairness']}}/10</h5>
            <h5>Easiness: {{$review['easiness']}}/10</h5>
            <h4>{{$review['title']}}</h4>
            <p>{{$review['content']}}</p>
            </div>

            @if($review['created_at'] != $review['updated_at'])

                <p>edited at {{$review['updated_at']}}</p>

            @endif

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


         <p>Liked by {{$review->reviewHelpfuls()->count()}}</p>
            @auth
            @if(!$review->reviewHelpfuledBy(auth()->user()))
                <form action="{{route('reviewHelpful', ['review' => $review->id, 'reviewIndex' => 'review'.$review->id ] ) }}" method="post" class="mr-1">@csrf
                    <button type="submit" class="text-blue-500">Helpful</button>
                </form>
            @else
                <form action="{{route('reviewHelpful', ['review' => $review->id, 'reviewIndex' => 'review'.$review->id ])}}" method="post" class="mr-1">
                    @csrf

                    @method('DELETE')
                     <button type="submit" class="text-blue-500">Unhelpful</button>
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
        <div id="commentForm" class="hiddenForm bg-blue-100 w-full  text-center mx-auto" style="display: none">
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
        <div class="bg-yellow-50 border-4 border-red-100 rounded-pill rounded-5 b-1 p-5 m-5" id="comment{{$comment->id}}">
            @else

                <div class="bg-white rounded-pill m-5 b-5 p-5" id="comment{{$comment->id}}">
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


