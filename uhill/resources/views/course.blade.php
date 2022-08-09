@extends('layout')

@section('content')


    <!-- Tab links -->
    @if(session()->get('returnScrollComment') !== null)
        <body onload="showFormScroll('comments')">
        <div class="bg-pink-500 text-white text-center"><button onclick="scrollToBottomWithSection({{ session()->get("scroll") }})"> Operation successful. Click to go back to the comment. </button></div>

        @elseif(session()->get('commented') !== null)
            <div class="bg-yellow-500 text-white text-center"><p>Commenting was Successful</p></div>
            <body onload="showForm('comments')">

            @elseif(session()->get('reviewIndex') !== null)

                <body onload="showForm('reviews')">

                <div class="bg-pink-500 text-white text-center"><button onclick="scrollToBottomWithSection({{ session()->get("reviewIndex") }})"> Operation successful. Click to go back to the review. </button></div>
                @else
                <body onload="showForm('reviews')">
            @endif

    <div id="content">
    @if(isset($message))
        <div class="bg-red-500 text-white text-center"><h3 class="text-lg">{{$message}}</h3></div>
    @endif

        <h1>{{$course['course_name']}}</h1>
        <h5>Overall rating: {{$course['overall']}} /10</h5>
        <a href="../teacher/{{$course->teacher['id']}}">Teacher: {{$course->teacher['name']}}</a>
        <p>Summary: {{$course['description']}}</p>


        <h5>Personality: {{$course['personality']}}/10</h5>
        <h5>Fairness: {{$course['fairness']}}/10 </h5>
        <h5>Easiness: {{$course['easiness']}}/10 </h5>




    <div class="tab">
        <button class="tablinks" onclick="show(event, 'reviews')"> Reviews </button>
        <button class="tablinks" onclick="show(event, 'comments')"> Comments </button>
    </div>

    <div id="reviews" class="tabcontent">
        <a class="bg-pink-300" href="/course/{{$course['id']}}/review"> Give review </a>
    @foreach($course->reviews as $review)
        <div class="bg-blue-50 m-5 b-5 border-4 border-green-500" id="review{{$loop->index}}">
             <a href="../profile/{{$review->user['id']}}">{{$review->user['username']}}: </a>
            <h5>Personality: {{$review['personality']}}/10</h5>
            <h5>Fairness: {{$review['fairness']}}/10</h5>
            <h5>Easiness: {{$review['easiness']}}/10</h5>
            <h4>{{$review['title']}}</h4>
            <p>{{$review['content']}}</p>


         <p>Liked by {{$review->reviewHelpfuls()->count()}}</p>

            @auth
            @if(!$review->reviewHelpfuledBy(auth()->user()))
                <form action="{{route('reviewHelpful', ['review' => $review->id, 'reviewIndex' => 'review'.$loop->index ] ) }}" method="post" class="mr-1">@csrf
                    <button type="submit" class="text-blue-500">Helpful</button>
                </form>
            @else
                <form action="{{route('reviewHelpful', ['review' => $review->id, 'reviewIndex' => 'review'.$loop->index ])}}" method="post" class="mr-1">
                    @csrf

                    @method('DELETE')
                     <button type="submit" class="text-blue-500">Unhelpful</button>
                 </form>
            @endif
            @endauth
        </div>

    @endforeach

    </div>


    <div id="comments" class="tabcontent">
        <div class="bg-blue-100 mx-3 w-1/6 text-center">
        <button class="" onclick="showForm('commentForm')"> Leave a comment </button>
        </div>
        <div id="commentForm" class="hiddenForm bg-blue-100 w-1/6 text-center mx-3" style="display: none">
            <form action="{{route('courseComment', $course['id'])}}" method="post">
                @method('HEAD')
                @csrf

                @if (Auth::check())
                    <label for="content">comment:</label>
                    <input class='bg-pink-100' type="text" name="content">
                    @error('content')
                    <p>{{$message}}</p>
                    @enderror
                    <button type="submit" class="text-blue-500">Submit</button>
                @else
                    <h1>YOU MUST BE LOGGED IN TO COMMENt</h1>
                @endif

            </form>
        </div>



        @foreach($course->comments->sortByDesc('created_at') as $comment)

            @if($comment->user == auth()->user())
        <div class="bg-yellow-50 border-4 border-red-100 rounded-pill m-1 b-1" id="comment{{$loop->index}}">
            @else

                <div class="bg-pink-100 rounded-pill m-1 b-1" id="comment{{$loop->index}}">
                    @endif

                    <a href="/profile/{{$comment->user->id}}"><p class="text-sm">{{$comment->user->username}}:</p></a>
            <p class="text-xl" >{{$comment['content']}}</p>
            <p class="text-sm">{{$comment->created_at}}</p>


            @if(!$comment->commentLikedBy(auth()->user()))
                <form action="{{route('courseCommentLike', ['id' => $comment->id, 'commentIndex' => 'comment'.$loop->index ] ) }}">
                    <button type="submit" >like</button>
                </form>

            @else

                <form action="{{route('courseCommentUnlike', ['id' => $comment->id, 'commentIndex' => 'comment'.$loop->index ] ) }}">
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


