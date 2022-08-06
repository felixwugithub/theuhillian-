@extends('layout')

@section('content')


    @if(isset($message))
        <h3 class="text-lg">{{$message}}</h3>
    @endif

    <h1 class="text-9xl">{{session()->get('scroll')}}</h1>

        <h1>{{$course['course_name']}}</h1>
        <h5>Overall rating: {{$course['overall']}} /10</h5>
        <a href="../teacher/{{$course->teacher['id']}}">Teacher: {{$course->teacher['name']}}</a>
        <p>Summary: {{$course['description']}}</p>


        <h5>Personality: {{$course['personality']}}/10</h5>
        <h5>Fairness: {{$course['fairness']}}/10 </h5>
        <h5>Easiness: {{$course['easiness']}}/10 </h5>


    <!-- Tab links -->
    @if(session()->get('returnScrollComment') !== null)
        <body class="overflow-auto" onload="returnScrollComment(900,'comments')"></body>
    @else
    <body onload="show('reviews')"></body>
    @endif

    <div class="tab">
        <button  onclick="show('reviews')"> Reviews </button>
        <button  onclick="show('comments')"> Comments </button>
    </div>

    <div id="reviews" class="tabcontent">
        <a class="bg-pink-300" href="/course/{{$course['id']}}/review"> Give review </a>



        <p>jj</p>
    @foreach($course->reviews as $review)
        <div style="background-color: aliceblue">
             <a href="../profile/{{$review->user['id']}}">{{$review->user['username']}}: </a>
            <h5>Personality: {{$review['personality']}}/10</h5>
            <h5>Fairness: {{$review['fairness']}}/10</h5>
            <h5>Easiness: {{$review['easiness']}}/10</h5>
            <h4>{{$review['title']}}</h4>
            <p>{{$review['content']}}</p>
        </div>

         <p>Liked by {{$review->reviewHelpfuls()->count()}}</p>

            @auth
            @if(!$review->reviewHelpfuledBy(auth()->user()))
                <form action="{{route('course', $review->id)}}" method="post" class="mr-1">@csrf
                    <button type="submit" class="text-blue-500">Helpful</button>
                </form>
            @else
                <form action="{{route('course', $review->id)}}" method="post" class="mr-1">
                    @csrf

                    @method('DELETE')
                     <button type="submit" class="text-blue-500">Unhelpful</button>
                 </form>
            @endif
            @endauth

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
        <div class="bg-pink-100 rounded-pill m-1 b-1">
            <p class="text-sm">{{$comment->user->username}}:</p>
            <p class="text-xl" >{{$comment['content']}}</p>
            <p class="text-sm">{{$comment->created_at}}</p>
        </div>

        @if(!$comment->commentLikedBy(auth()->user()))
            <form action="{{route('courseCommentLike', $comment->id)}}">
                <button type="submit" >like</button>
            </form>

            @else

                <form action="{{route('courseCommentUnlike', $comment->id, )}}">
                    <button type="submit" >Unlike</button>
                </form>

            @endif
            <p>Liked by {{$comment->commentLikes()->count()}}</p>
        @endforeach


    </div>

    <script src="/js/parts.js"> </script>


    </body>
@endsection


