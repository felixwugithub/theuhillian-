@extends('layout')

@section('content')

    <div class="bg-white">




    <!-- Tab links -->
    @if(session()->get('reviewIndex') !== null && session()->get('simple'))
        <body class="overflow-visible bg-white text-notRealBlack" onload="showFormAndScroll('reviews', {{ session()->get("reviewIndex") }})">
    @elseif(session()->get('returnScrollComment') !== null)
        <body class="overflow-visible bg-white text-notRealBlack" onload="showFormAndScroll('comments', {{ session()->get("scroll") }})">
        <div  class="bg-pink-500 text-white text-center"><button onclick="scrollToBottomWithSection({{ session()->get("scroll") }})"> Operation successful. Click to go back to the comment. </button></div>

        @elseif(session()->get('commented') !== null)

            <body class="overflow-visible bg-white text-notRealBlack" onload="showForm('comments')">

            @elseif(session()->get('reviewIndex') !== null)

            <body class="overflow-visible bg-white text-notRealBlack" onload="showFormAndScroll('reviews', {{ session()->get("reviewIndex") }})">
                <div class="bg-pink-500 text-white text-center"><button onclick="scrollToBottomWithSection({{ session()->get("reviewIndex") }})"> Operation successful. Click to go back to the review. </button></div>
                @else
                <body class="overflow-visible bg-white text-notRealBlack" onload="showForm('reviews')">
            @endif

    <div id="content bg-hotPink">

        @if(session()->get('message') != null)
            <div class="bg-red-500 text-white text-center mt-5 md:pt-0"><h3 class="text-lg">{{session()->get('message')}}</h3></div>
        @endif


        <div class="md:flex justify-center pt-5 bg-gradient-to-r from-pinkWhite lg:via-felixSalmon to-felixSalmon lg:to-hotPink items-center">

            <div class="md:w-5/12 md:py-5 md:px-12 m-5">
                <h1 class="font-sf text-5xl mb-3">{{$course['course_name']}}</h1>

                <p class="font-sansMid">{{$course['description']}}</p>


                @auth()
                <a class="bg-hotPink text-white  w-56 h-14 m-5 text-3xl items-center py-auto font-sf text-center justify-center mx-auto flex rounded-lg" href="/course/{{$course['id']}}/review"> Give review </a>
                @else
                    <a class="bg-hotPink text-white  w-56 h-14 m-5 text-3xl items-center py-auto font-sf text-center justify-center mx-auto flex rounded-lg hover:bg-yellow-200" href="/register"> Give Review </a>
                @endauth
            </div>

            <div class="space-y-3">
                <div class="text-center justify-center w-36 h-36 p-3 rounded-2xl border-2 border-hotPink container relative mx-auto">
                    <p class="text-hotPink text-xl  font-ooga">Difficulty:</p>
                    <h1 class="text-7xl font-slim text-spicyPink">{{number_format($course['difficulty'],1,'.','')}}</h1>
                    <h1 class="font-slim text-sm text-hotPink bottom-1 right-2 absolute">/10</h1>
                </div>

                <p class="mx-auto text-hotPink font-slim w-2/3 text-xs"> *Difficulty ratings do not affect a course's overall rating.</p>

            </div>
            <div class="flex md:flex-none md:w-1/2">

                <div class="w-2/3 md:w-3/4 text-lg md:rounded-3xl md:mx-5 md:my-auto p-5 md:text-left container relative space-y-5 text-red-900 font-quicksand-regular">

                    <div class="flex items-center justify-content-around  container relative w-full">
                        <h5 class="md:flex font-sf text-xl mx-auto">Overall: </h5>
                        <h5 class="md:flex font-sf text-xl ">{{number_format($course['overall'], 1, '.', '')}} /10</h5>
                        <p class="md:flex font-sf text-xl md:mx-auto"></p>
                        <img src="/images/star-ratings/{{floor($course['overall']+0.5)}}.png" alt="" class="w-36 h-6 hidden xl:block mx-auto right-0 absolute">
                    </div>

                    <div class="flex items-center justify-content-around container relative w-full">
                        <h5 class=" text-xl mx-auto">Workload: </h5>
                        <h5 class=" text-xl "> {{number_format($course['personality'], 1, '.','')}}/10</h5>
                        <p class="md:flex font-sf text-xl md:mx-auto md:w-12"></p>
                        <img src="/images/star-ratings/{{floor($course['personality']+0.5)}}.png" alt="" class="w-36 h-6  hidden xl:block mx-auto right-0 absolute">
                    </div>

                    <div class="flex items-center justify-content-around container relative w-full">
                        <h5 class=" text-xl mx-auto">Fun:</h5>
                        <h5 class=" text-xl ">{{number_format($course['fairness'],1,'.','')}}/10 </h5>
                        <p class="md:flex font-sf text-xl md:mx-auto md:w-5"></p>
                        <img src="/images/star-ratings/{{floor($course['fairness']+0.5)}}.png" alt="" class="w-36 h-6  hidden xl:block mx-auto right-0 absolute">
                    </div>

                    <div class="flex items-center justify-content-around container relative w-full">
                         <h5 class=" text-xl mx-auto">Content Coverage: </h5>
                        <h5 class=" text-xl ">{{number_format($course['content_coverage'],1,'.','')}}/10 </h5>
                        <p class="md:flex font-sf text-xl md:mx-auto md:w-[7rem]"></p>
                        <img src="/images/star-ratings/{{floor($course['content_coverage']+0.5)}}.png" alt="" class="w-36 h-6  hidden xl:block mx-auto right-0 absolute">
                    </div>
                </div>

                @auth()
                @if(!$course->courseJoined(auth()->user()))
                <div class="md:m-auto md:mr-5 flex w-5/12 md:w-36 justify-center m-2 rounded-[12%] md:border-0 bg-white bg-opacity-30">
                    <a class="font-readex  md:text-lg" href="{{route('joinCourse', ['id' => $course->id])}}">
                        <div class="rounded-lg hover:bg-pinkWhite">
                                <div class="w-auto h-full m-4">
                                 <h1 class="font-sf text-black lg:text-white"> JOIN THIS COURSE </h1>
                                    <hr class="border-1 border-black lg:border-white lg:w-20">
                                <p class="text-sm text-gray-500 lg:text-gray-50 lg:mt-1"> You will receive notifications when someone reviews this course. </p>
                                </div>
                        </div>
                    </a>
                </div>

                @else
                    <div class="md:m-auto md:mr-5 flex w-5/12 md:w-36 justify-center bg-opacity-50 bg-pink-50 m-2 rounded-[12%] md:border-0">
                        <a class="font-readex md:text-lg" href="{{route('quitCourse', ['id' => $course->id])}}">
                            <div class="rounded-lg hover:bg-pinkWhite">
                                    <div class="w-auto h-full m-4">
                                        <h1 class="font-sf text-black lg:text-white"> QUIT THIS COURSE </h1>
                                        <hr class="border-1 border-black lg:border-white lg:w-20">
                                        <p class="text-sm mt-1 text-gray-500 lg:text-gray-50"> You will no longer receive notifications in your dashboard.</p>
                                    </div>
                            </div>
                        </a>
                    </div>
                @endif
                @endauth
            </div>



        </div>

                <div class="tab pt-3 pb-10 w-full text-spicyPink">
                    <button class="tablinks" onclick="show(event, 'reviews')"> Reviews </button>
                    <button class="tablinks" onclick="show(event, 'comments')"> Comments </button>
                </div>


        <div class="infinite-scroll bg-gradient-to-r from-pinkWhite lg:via-pinkWhite to-felixSalmon lg:to-pinkWhite w-full justify-center mx-auto">

            <div id="reviews" class="tabcontent">

             @foreach($reviews->sortBy('created_at') as $review)

                <div class="bg-felixSalmon m-5 p-5 b-5 relative container w-auto mx-auto" id="review{{$review->id}}" >

                    @auth
                          @if(!auth()->user()->review_reports->pluck('review_id')->contains($review->id))
                        <a class="text-xs text-spicyPink font-comfortaa" href="/report-review/{{$review->id}}"> Report </a>
                        @else
                            <p class="text-xs text-red-500 font-comfortaa" >reported</p>
                          @endif
                    @endauth

                    <!-- <svg class="h-0.7 w-80 m-auto box-shadow mb-3"><rect class="w-80 h-1 rounded-3 m-auto "></rect></svg>
                    -->
                    <h1 class="text-3xl text-center md:text-center font-quicksand-regular">{{$review['title']}}</h1>

                    <div id="reviewBlock{{$review->id}}" class="text-center">
                    <a class="font-didact hover:text-hotPink" href="../profile/{{$review->user['id']}}"> from <span class="text-xl text-hotPink"> {{$review->user['username']}} </span> </a>
                    </div>



                        <p class="m-4 text-l font-sans mt-3">{{$review['content']}}</p>



                    <ul class=" text-gray-600 font-medium text-center rounded-lg divide-x divide-white sm:flex mt-6 mb-3">
                        <li class="w-full text-center">
                            <h5>Workload: {{$review['personality']}}/10</h5>
                            <img src="/images/star-ratings/{{$review['personality']}}.png" alt="" class="w-48 h-8 mx-auto hidden md:block">
                        </li>
                        <li class="w-full">
                            <h5>Fun: {{$review['fairness']}}/10</h5>
                            <img src="/images/star-ratings/{{$review['fairness']}}.png" alt="" class="w-48 h-8 mx-auto hidden md:block">
                        <li class="w-full">
                            <h5>Content Coverage: {{$review['content_coverage']}}/10</h5>
                            <img src="/images/star-ratings/{{$review['content_coverage']}}.png" alt="" class="w-48 h-8 mx-auto hidden md:block">
                        </li>

                    </ul>


                    <div class="w-full flex justify-center">

                    <div class=" text-center justify-center w-36 h-15 rounded-2xl m-2 border-2 border-hotPink container xl:top-2 xl:right-2 xl:absolute xl-auto">
                        <p class="text-hotPink  font-ooga">" Difficulty:</p>
                        <h1 class="text-4xl font-slim text-spicyPink">{{$review['difficulty']}}</h1>
                        <h1 class="font-ooga text-hotPink bottom-1 right-2 xl:absolute">/10 "</h1>
                    </div>

                    </div>


                    @auth
                        @if($review->user->id == auth()->id())

                            <div class="flex w-full text-center mx-auto space-x-6 justify-center">
                            <button class="items-center text-center text-hotPink" onclick="showFormAndHide('reviewEditForm', 'reviewBlock{{$review->id}}')"> Edit </button>
                            <form action="{{route('reviewDelete', ['review_id' => $review->id])}}">
                                <button class="text-hotPink" type="submit">Delete</button>
                            </form>
                            </div>

                        <div class="hidden" id="reviewEditForm">
                            <form action="{{route('reviewUpdate', ['review_id' => $review->id])}}">
                                @csrf


                                <div class="relative z-0 my-6 w-full group font-ooga">

                                    <input value="{{$review['title']}}" type="text" name="title" id="title" class="block pt-2.5 pb-1 px-0 w-full text-2xl text-notRealBlack font-readex text-gray-900 bg-transparent border-0 border-b-2 border-hotPink appearance-none dark:text-white dark:border-gray-600 dark:focus:border-hotPink focus:outline-none focus:ring-0 focus:border-spicyPink peer" placeholder=" " required/>
                                    <label for="title" class="peer-focus:font-medium absolute text-lg text-hotPink hotPink-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-100 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-spicyPink peer-focus:dark:text-hotPink peer-placeholder-shown:scale-120 peer-placeholder-shown:translate-y-0 peer-focus:scale-125 peer-focus:-translate-y-6"

                                    >Review Title</label>

                                    @error('title')
                                    <p>{{$message}}</p>
                                    @enderror
                                </div>


                                <div class="w-full flex justify-content-around font-ooga text-spicyPink">

                                    <div class="w-1/3">
                                        <label for="personality">Workload</label>
                                        <input id="personality" type="number" name="personality" class="w-14 h-8 rounded-[20%] bg-pinkie border-0 focus:border-5 focus:ring-hotPink focus:border-felixSalmon"
                                               value="{{$review['personality']}}" min="1" max="10" required>

                                        @error('personality')
                                        <p>{{$message}}</p>
                                        @enderror
                                    </div>

                                    <div class="w-1/3">
                                        <label for="fairness">Fun</label>
                                        <input id="fairness" type="number" name="fairness" class="w-14 h-8 rounded-[20%] bg-pinkie border-0 focus:border-5 focus:ring-hotPink focus:border-felixSalmon"
                                               value="{{$review['fairness']}}" min="1" max="10" required>

                                        @error('fairness')
                                        <p>{{$message}}</p>
                                        @enderror
                                    </div>

                                    <div class="w-1/3">
                                        <label for="content_coverage">Content Coverage</label>
                                        <input id="content_coverage" type="number" name="content_coverage" class="w-14 h-8 rounded-[20%] bg-pinkie border-0 focus:border-5 focus:ring-hotPink focus:border-felixSalmon"
                                               value="{{$review['content_coverage']}}" min="1" max="10" required>

                                        @error('content_coverage')
                                        <p>{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>


                                <div class="font-ooga text-spicyPink">
                                    <div class="w-1/3 mt-10 justify-center mx-auto">
                                        <label for="difficulty" class="w-full text-center font-ooga text-spicyPink text-lg">Difficulty</label>
                                        <p class="font-slim text-sm text-spicyPink">The difficulty rating does not affect a course's overall rating.</p>
                                        <input id="easiness" type="number" name="difficulty" class="w-14 h-8 rounded-[20%] bg-red-200 border-0 focus:border-5 focus:ring-red-500 focus:border-red-500"
                                               value="{{$review['difficulty']}}" min="1" max="10" required>
                                        @error('difficulty')
                                        <p>{{$message}}</p>
                                        @enderror
                                    </div>


                                    <div class="mt-10 w-full">

                                        <label for="content" class="w-full mx-auto text-center font-ooga text-spicyPink text-lg">Write your full review here: </label>
                                        <textarea id="content" name="content" class="w-full align-top items-start h-64 bg-pinkie border-0 focus:border-5 focus:ring-hotPink focus:border-felixSalmon p-5" minlength="10" maxlength="2000">{{$review['content']}}</textarea>

                                        @error('content')
                                        <p>{{$message}}</p>
                                        @enderror

                                    </div>
                                </div>
                                <div class="flex justify-center">
                                <button type="submit" class="px-3 py-1 bg-spicyPink rounded-md text-center mx-auto text-white mt-3">Finished!</button>
                                </div>
                            </form>
                        </div>



                        @endif

                    @endauth


                    <div class="flex justify-around">
                        @auth
                        @if(!$review->reviewHelpfuledBy(auth()->user()))
                            <form action="{{route('reviewHelpful', ['review' => $review->id, 'reviewIndex' => 'review'.$review->id ] ) }}" method="post" class="mr-1 flex space-x-4">@csrf
                                <p>Found helful by {{$review->reviewHelpfuls()->count()}} others</p>
                                <button type="submit" class="text-hotPink">Helpful</button>
                            </form>
                        @else
                            <form action="{{route('reviewHelpfulDestroy', ['review' => $review->id, 'reviewIndex' => 'review'.$review->id ])}}" method="post" class="mr-1 flex space-x-4">
                                @csrf
                                @method('DELETE')
                                <p>Found helful by {{$review->reviewHelpfuls()->count()}} others</p>
                                 <button type="submit" class="text-pink-800">Unhelpful</button>
                             </form>
                        @endif
                        @endauth

                    </div>

                    <div class="text-xs text-gray-500 font-comfortaa text-center mt-3">

                    @if($review['created_at'] != $review['updated_at'])

                        <p> (edited at {{$review['updated_at']}})</p>

                    @else

                        <p> {{$review['created_at']}}</p>

                    @endif

                    </div>


                </div>

                    @endforeach


                 <p class="mx-auto flex justify-center text-2xl font-slim"></p>
                 <div class="w-11/12 flex justify-center items-center mx-auto text-lg font-slim">

                     {{$reviews->links()}}

                 </div>

                <div class="h-full h-[12rem]">

                </div>

            </div>


        </div>

            <div>

    <div id="comments" class="tabcontent bg-felixSalmon justify-center justify-content-center">
        <div class=" mx-3 w-full flex justify-center mx-auto pt-3">
        <button class="items-center text-center border-2 border-hotPink mb-4 rounded-3xl text-hotPink p-3" onclick="showForm('commentForm')"> Comment </button>
        </div>
        <div id="commentForm" class="hiddenForm  mx-3 w-full flex justify-center mx-auto" style="display: none">
            <form action="{{route('courseComment', $course['id'])}}" method="post">
                @method('HEAD')
                @csrf

                @if (Auth::check())
                    <input class='bg-white/30 w-full' type="text" name="content">
                    @error('content')
                    <p>{{$message}}</p>
                    @enderror
                <div>
                    <button type="submit" class="text-hotPink rounded-lg my-3 px-5 py-2 border-2 border-hotPink hover:bg-spicyPink mx-auto justify-center flex">Submit</button>
                </div>
                @else
                    <h1>YOU MUST BE LOGGED IN TO COMMENt</h1>
                @endif

            </form>
        </div>


        <div class="scrolling-pagination">

{{--        @foreach($comments->sortByDesc('created_at') as $comment)--}}

{{--            @if($comment->user == auth()->user())--}}
{{--        <div class="bg-yellow-50 border-4 border-red-100 rounded-pill rounded-5 b-1 p-5 m-1" id="comment{{$comment->id}}">--}}
{{--            @else--}}

{{--                <div class="bg-white rounded-pill m-1 b-3 p-5" id="comment{{$comment->id}}">--}}
{{--                    @endif--}}

{{--                    <a href="/profile/{{$comment->user->id}}"><p class="text-sm">{{$comment->user->username}}:</p></a>--}}
{{--            <p class="text-xl" >{{$comment['content']}}</p>--}}
{{--            <p class="text-sm">{{$comment->created_at}}</p>--}}


{{--            @if(!$comment->commentLikedBy(auth()->user()))--}}
{{--                <form action="{{route('courseCommentLike', ['id' => $comment->id, 'commentIndex' => 'comment'.$comment->id ] ) }}">--}}
{{--                    <button type="submit" >like</button>--}}
{{--                </form>--}}

{{--            @else--}}

{{--                <form action="{{route('courseCommentUnlike', ['id' => $comment->id, 'commentIndex' => 'comment'.$comment->id] ) }}">--}}
{{--                    <button type="submit" >Unlike</button>--}}

{{--                </form>--}}

{{--            @endif--}}
{{--            <p>Liked by {{$comment->commentLikes()->count()}}</p>--}}


{{--        </div>--}}


{{--        @endforeach--}}

{{--          --}}



            <div class="container mt-5">
                <div id="data-wrapper">
                    <!-- Results -->
                </div>
                <!-- Data Loader -->
                <div class="auto-load text-center">
                    <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                <path fill="#000"
                      d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                      from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                </path>
            </svg>
                </div>
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                var ENDPOINT = "{{ url('/') }}";
                var page = 1;
                infinteLoadMore(page);
                $(window).scroll(function () {
                    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                        page++;
                        infinteLoadMore(page);
                    }
                });
                function infinteLoadMore(page) {
                    $.ajax({
                        url: ENDPOINT + "/course/{{$course->id}}?comments=" + page,
                        datatype: "html",
                        type: "get",
                        beforeSend: function () {
                            $('.auto-load').show();
                        }
                    })
                        .done(function (response) {
                            if (response.length == 0) {
                                $('.auto-load').html("You've reached the end of comments.");
                                return;
                            }
                            $('.auto-load').hide();
                            $("#data-wrapper").append(response);
                        })
                        .fail(function (jqXHR, ajaxOptions, thrownError) {
                            console.log('Server error occured');
                        });
                }
            </script>

        </div>

    </div>
    </div>
                <script src="/js/parts.js"> </script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
                <script src="/js/jquery.jscroll.min.js"></script>
    </div>



    </div>
@endsection


