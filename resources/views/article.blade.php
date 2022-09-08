@extends('layout')

@section('content')

    @if(session()->get('liked-article'))
        <body onload="document.getElementById('likeBar').scrollIntoView()"></body>
        @elseif(session()->get('commented'))
        <body onload="document.getElementById('commentBar').scrollIntoView()"></body>
        @elseif(session()->get('liked-article-comment') !== null)
                <script type="text/javascript">
                    function codeAddress() {
                        for (let i = 2; i <= {{session()->get('comment-pos')}}; i++) {
                            infinteLoadMore(i);
                            setTimeout(function (){
                                document.getElementById('{{session()->get('liked-article-comment')}}').scrollIntoView();
                            }, {{session()->get('comment-pos')}} * 100);
                            page=i;
                        }

                    }
                    window.onload = codeAddress;

                </script>
    @endif





    <!--

         You can access the following variables/functions/classes by surrounding them with double curly brackets,
        or work with them using blade @ tags

        - current user:                      auth()->user()
        - current user's unique id           auth()->id()
        - boolean of logged in or not        auth()->check()
        - additional user information        auth()->user()->[name of the variable without dollar sign]  (example: auth()->user()->username)
        - classes that belong to the user    auth()->user()->[name of the class]->[name of the variable] (example: auth()->user->profile->description)

        - the articles displayed on the current page, as array:    $articles
        - each individual article:                                 $article


        - article title:            $article->title
        - article's user:           $article->user->[user property, such as username]         [nullable]
        - article's club:           $article->club->[club property, such as description]      [nullable]
        - article's author name:    $article->author
        - article's content:        $article->content


       These are the essentials, but there are more available. Ask your backend dev felix
       You can use built in php functions, too. for example, str_replace(' ', '_', $club->name)
       if you need more variables or functions, such as a function that checks whether a user has joined a club: $club->clubJoined($user User)

        note: when using a variable that is nullable, check that it is set before using it.

    -->
    <div class="container max-w-[4000px] lg:w-[85%] w-full p-10 mx-auto  bg-paper">

        @if(isset($article->articlepdf))
            <a class="w-full h-full overflow-hidden underline text-sm text-gray-500 font-slim py-10" id="articlePDF" href="/storage/articlePDFs/{{$article->articlepdf->pdf}}">View Original PDF</a>
        @endif

        <h1 class="text-3xl md:text-5xl font-sf">
        {{$article->title}}
        </h1>

        <div class="pt-3">
            <h1 class="text-xl font-readex mt-3">
                {{$article->author}}
            </h1>
        </div>

        @if(isset($article->cover->image))
            <img class="my-5" src="/storage/articleCovers/{{$article->cover->image}}" alt="">
        @endif



        <div class="trix-editor ">
            {!! $content !!}
        </div>

            <div class="md:flex md:space-x-6 space-y-5 md:space-y-2">

                @auth

                <div id="likeBar" class="pt-3">

                        <form action="{{route('like-article', ['id' => $article->id])}}">
                            @method('POST')
                            @csrf
                            <div class="flex items-center text-md font-comfortaa space-x-6">

                            @if($article->isLikedBy(auth()->user()))
                                <button ><img class="w-8 h-8" src="/images/icons/liked.png" alt=""> </button>
                            @else
                                <button> <img class="w-8 h-8" src="/images/icons/like.png" alt=""></button>
                            @endif
                                <p>Liked by {{$article->likers()->count()}}</p>
                            </div>

                        </form>

                </div>

            <div id="commentBar" class="md:w-2/3 w-full right-0 relative">
                <form class="flex md:space-x-6 items-center" action="{{route('article-comment', ['id' => $article->id])}}">
                    <div class="relative z-0 mb-6 w-full group">
                        <input type="text" name="content" id="content" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-spicyPink peer" placeholder=" " required minlength="2" maxlength="1000"/>
                        <label for="content" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-spicyPink peer-focus:dark:text-hotPink peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Your Comment</label>
                    </div>
                    <button class="text-gray-700 hover:text-spicyPink px-10 rounded-xl font-comfortaa pb-2"> Post! </button>
                </form>
            </div>

                    @else
                    <p>Login to comment & like</p>
                @endauth


    </div>

            <div id="comments">

                <div class="container mt-5 overflow-visible">
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
                        if ($(window).scrollTop() + $(window).height() + 120 >= $(document).height()) {
                            page++;
                            infinteLoadMore(page);
                        }
                    });


                    function infinteLoadMore(page) {
                        $.ajax({
                            url: ENDPOINT + "/article-comments/{{$article->id}}?comments=" + page,
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





@endsection
