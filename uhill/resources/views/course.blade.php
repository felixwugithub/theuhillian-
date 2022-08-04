@extends('layout')

@section('content')


    @if(isset($message))

        <h3 class="text-lg">{{$message}}</h3>

    @endif

        <h1>{{$course['course_name']}}</h1>
        <h5>Overall rating: {{$course['overall']}} /10</h5>
        <a href="../teacher/{{$course->teacher['id']}}">Teacher: {{$course->teacher['name']}}</a>
        <p>Summary: {{$course['description']}}</p>


        <h5>Personality: {{$course['personality']}}/10</h5>
        <h5>Fairness: {{$course['fairness']}}/10 </h5>
        <h5>Easiness: {{$course['easiness']}}/10 </h5>


    <!-- Tab links -->
    @if(session()->get('showComments') !== null)
        <body onload="show('comments')"></body>
    @else
    <body onload="show('reviews')"></body>
    @endif

    <div class="tab">
        <button  onclick="show('reviews')"> Reviews </button>
        <button  onclick="show('comments')"> Comments </button>
    </div>

    <div id="reviews" class="tabcontent">
        <a class="bg-pink-300" href="/course/{{$course['id']}}/review"> Give review </a>

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
    @endforeach

    </div>


    <div id="comments" class="tabcontent">
        <button  onclick="showForm('commentForm')"> Leave a comment </button>
        <div id="commentForm" class="hiddenForm" style="display: none">
            <p> Leave your comment:</p>
            <form action="{{route('courseComment', $course['id'])}}" method="post">
                @method('HEAD')
                @csrf
                <label for="comment">comment:</label>
                <input type="text" name="comment">
                <button type="submit" class="text-blue-500">Submit</button>
            </form>
        </div>




    </div>

    <script src="/js/parts.js"> </script>

@endsection


