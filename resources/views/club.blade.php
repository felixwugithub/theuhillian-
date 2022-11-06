@extends('layout')

@section('content')



    <!--

               You can access the following variables/functions/classes by surrounding them with double curly brackets,
        or work with them using blade @ tags

        - current user:                      auth()->user()
        - current user's unique id           auth()->id()
        - boolean of logged in or not        auth()->check()
        - additional user information        auth()->user()->[name of the variable without dollar sign]  (example: auth()->user()->username)
        - classes that belong to the user    auth()->user()->[name of the class]->[name of the variable] (example: auth()->user->profile->description)

        - each individual club:                                 $club

        - unique club name:         $club->name
        - unique club id:           $club->id
        - club description:         $club->description          [nullable]
        - club room number:         $club->room_number          [nullable]
        - club president name:      $club->president            [nullable]
        - club vice president name: $club->vice_president       [nullable]
        - club meeting times:       $club->meeting_times        [nullable]
        - club overall rating:      $club->overall              (might be removed)


       These are the essentials, but there are more available.
       You can use built in php functions, too. for example, str_replace(' ', '_', $club->name)
       Ask your backend dev felix
       if you need more variables or functions, such as a function that checks whether a user has joined a club: $club->clubJoined($user User)

        note: when using a variable that is nullable, check that it is set before using it.

    -->

    <div class="container w-full  m-auto">



        <div class="container mx-auto pt-5 justify-center flex pb-5">
            <div class="text-center">
                <h1 class="text-3xl md:text-6xl font-readex mx-auto text-center w-full">{{strtoupper($club->name)}}</h1>

                @if(isset($club->president))
                    <p class="font-quicksand-regular">President: {{$club->president}}</p>
                @endif

                @if(isset($club->vice_president))
                    <p class="font-quicksand-regular">Vice President: {{$club->vice_president}}</p>
                @endif
            </div>
        </div>
                    @if(isset($club->club_cover_image->image))
                        <div class="bg-cover w-full h-96" style="background-image: url('/storage/clubCoverImages/{{$club->club_cover_image->image}}') no-repeat left center">
                    @else
                        <div class="bg-cover w-full">
                    @endif

                        </div>


                                <div class="mx-auto mt-5 flex justify-center bg-blue-50 hover:bg-defaultDarkerBlue hover:text-white rounded-md hover:shadow-lg p-5 w-44 w-auto">
                                    @if(auth()->check())
                                        @if(!$club->clubJoined(auth()->user()))
                                            <a href="{{route('joinClub', ['id' => $club->id])}}"> Join this club </a>
                                        @else
                                            <a href="{{route('quitClub', ['id' => $club->id])}}"> Quit this club </a>
                                        @endif

                                    @else
                                        <a href="/login" class="text-xs text-center rounded-2xl">Login to follow this club for events, news, and updates.</a>
                                    @endif
                                </div>

        <div class="mx-auto container md:w-7/12 mt-3">


            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center justify-content-around justify-center mx-auto" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 rounded-t-lg border-b-2 text-blue-500" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Blog</button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Articles</button>
                    </li>
                    <li class="mr-2" role="presentation">

                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings"

                                @if(session()->get('openEvents'))
                                aria-selected="true"
                                @else
                                aria-selected="false"
                                @endif


                        > Events</button>
                    </li>
                    <li role="presentation">
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Info</button>
                    </li>
                </ul>
            </div>

            <div id="myTabContent">


                <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    <div class="text-center justify-center mx-auto">
                    @if(auth()->check())
                        @if(auth()->user()->admin == 1)

                            <button class="justify-center mx-auto flex-wrap items-center text-center text-sm p-2 rounded-xl bg-blue-50 hover:bg-white" onclick="showHideDiv('club-post-form')"> New Post
                                @error('caption')
                                    <p class="text-red-800 m-auto">{{$message}}</p>
                                    @enderror

                                    @error('images')
                                    <p class="text-red-800 m-auto" >{{$message}}</p>
                                    @enderror

                            </button>


                            <form id="club-post-form" action="{{route('club-post-store',['club_id' => $club->id])}}" method="post" enctype="multipart/form-data" style="display: none">
                                @csrf
                                @method('POST')

                                    <label for="caption" class="block mb-2 text-gray-900 dark:text-gray-300">Caption</label>
                                    <input type="text" id="caption" name="caption" class="block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-100 focus:border-blue-100 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-200 dark:focus:border-blue-500">


                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="images">Upload Images</label>
                                    <input class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="images" name="images[]" type="file" multiple=true>


                                    <button type="submit" class="text-blue-800 mx-auto mt-3 justify-center flex bg-blue-50 hover:bg-yellow-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Post! </button>

                            </form>


                        @endif
                    @endif
                    </div>


                        <div class="container mt-5 p-2">
                            <div id="data-wrapper" >
                                <div class="h-1"></div>
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
                </div>


                <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">

                        <div class="container mt-5 p-2">

                            @if(auth()->check())
                                @if(auth()->user()->admin == 1)
                                    <a href="/club-magazine-manager/{{$club->id}}" class="flex mx-auto w-full justify-center">
                                        <div class="w-1/3 rounded-md text-blue-900 bg-blue-50 text-center hover:bg-blue-500 hover:text-white">
                                            Manage Articles
                                        </div>
                                    </a>
                                @endif
                            @endif

                            <div id="data-wrapper2">
                                <!-- Results -->
                            </div>
                            <!-- Data Loader -->
                            <div class="auto-load2 text-center">
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
                </div>


                <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                    @if(auth()->check())
                        @if(auth()->user()->admin == 1)

                                <button class="justify-center mx-auto flex-wrap items-center text-center text-sm p-2 mt-5 rounded-xl bg-blue-50 hover:bg-white" onclick="showHideDiv('club-event-form');document.getElementById('club-event-form').scrollIntoView();"> New Event

                                        @error('name')
                                        <p class="text-red-800 m-auto">{{$message}}</p>
                                        @enderror

                                        @error('description')
                                        <p class="text-red-800 m-auto" >{{$message}}</p>
                                        @enderror

                                         @error('location')
                                          <p class="text-red-800 m-auto" >{{$message}}</p>
                                         @enderror

                                        @error('start-time')
                                        <p class="text-red-800 m-auto" >{{$message}}</p>
                                        @enderror

                                        @error('end-time')
                                         <p class="text-red-800 m-auto" >{{$message}}</p>
                                         @enderror

                                        @error('url')
                                        <p class="text-red-800 m-auto" >{{$message}}</p>
                                         @enderror


                                </button>


                            <form id="club-event-form" action="{{route('club-event-store',['club_id' => $club->id])}}" method="post" enctype="multipart/form-data" style="display: none" class="p-5 mt-5 space-y-3">
                                @csrf
                                @method('POST')

                                    <label for="caption" class="block mt-2 text-gray-900 dark:text-gray-300">Event Name</label>
                                    <input type="text" id="name" name="name" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-100 focus:border-blue-100 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-200 dark:focus:border-blue-500" value="{{old('name')}}">

                                    <label for="description" class="block mt-2 text-gray-900 dark:text-gray-300">Description</label>
                                    <input type="text" id="description" name="description" class="block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-100 focus:border-blue-100 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-200 dark:focus:border-blue-500" value="{{old('description')}}">

                                    <label for="location" class="block mt-2 text-gray-900 dark:text-gray-300">Location</label>
                                    <input type="text" id="location" name="location" class="block p-1 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-100 focus:border-blue-100 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-200 dark:focus:border-blue-500" value="{{old('location')}}">


                                <div class="flex justify-between">
                                        <div class="w-1/2">
                                            <label for="start_time">Start Time:</label>
                                            <input type="datetime-local" id="start_time" name="start_time" class="block p-4 w-56 lg:w-11/12 text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-100 focus:border-blue-100 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-200 dark:focus:border-blue-500" value="{{old('start-dateTime')}}">
                                        </div>

                                        <div class="w-1/2">
                                            <label for="end_time">End Time:</label>
                                            <input type="datetime-local" id="end_time" name="end_time" class="block p-4 w-56 lg:w-11/12 text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-100 focus:border-blue-100 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-200 dark:focus:border-blue-500" value="{{old('end-dateTime')}}">
                                        </div>
                                    </div>

                                    <label for="url" class="block mt-2 text-gray-900 dark:text-gray-300">URL</label>
                                    <input type="text" id="url" name="url" class="block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-100 focus:border-blue-100 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-200 dark:focus:border-blue-500" value="{{old('url')}}">


                                <button type="submit" class="text-blue-800 mx-auto mt-3 justify-center flex bg-blue-50 hover:bg-yellow-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Add Event </button>

                            </form>

                        @endif
                    @endif

                        <div id="data-wrapper3">
                            <div class="h-5 mb-10"></div>
                            <!-- Results -->
                        </div>
                        <!-- Data Loader -->
                        <div class="auto-load3 text-center">
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


                <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                    @if(auth()->check())
                        @if(auth()->user()->admin == 1)
                            <a href="/club-manager/{{$club->id}}" class="flex mx-auto w-full justify-center">
                                <div class="w-1/3 rounded-md text-blue-900 bg-blue-50 text-center hover:bg-blue-500 hover:text-white">
                                    Manage Club Info
                                </div>
                            </a>
                        @endif
                    @endif

                    <div class="m-3 p-5 mx-auto space-y-3">
                        <div>
                            <div class="mt-3">
                             <h1 class="text-3xl font-bold">{{$club->name}}</h1>
                             <h1 class="font-slim text-xl">{{$club->description}}</h1>
                            </div>

                            <div class="my-5 font-modern">
                            @if(isset($club->president))
                            <h1>President: {{$club->president}}</h1>
                            @endif

                            @if(isset($club->vice_president))
                            <h1>Vice President: {{$club->vice_president}}</h1>
                            @endif
                            </div>

                            <div class="flex justify-between font-modern">
                                <h1 class="w-5/12">Room: {{$club->room_number}}</h1>
                                <h1 class="w-5/12">Time: {{$club->meeting_times}}</h1>
                            </div>


                        </div>

                        <div class="hover:bg-blue-50">
                        <a class="text-blue-700 text-center w-full" href="{{$club->url}}">URL:  {{$club->url}}</a>
                        </div>

                        <h1>Member Count: {{count($club->club_members)}} </h1>

                    </div>
                </div>

        </div>

            @if(session()->get('scrollDown'))
                <body onload="window.scroll(0, 500)"></body>
            @endif


    </div>



                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                <script src="/js/parts.js"> </script>
                                <script>
                                    var ENDPOINT = "{{ url('/') }}";
                                    var postPage = 1;
                                    var articlePage = 1;
                                    var eventPage = 1;

                                    infinteLoadMorePosts(postPage);
                                    infinteLoadMoreArticles(articlePage);
                                    infinteLoadMoreEvents(eventPage);

                                    $(window).scroll(function () {
                                        if ($(window).scrollTop() + $(window).height() + 128 >= $(document).height()) {
                                            postPage++;
                                            articlePage++;
                                            eventPage++;
                                            infinteLoadMorePosts(postPage);
                                            infinteLoadMoreArticles(articlePage);
                                            infinteLoadMoreEvents(eventPage);
                                        }
                                    });
                                    function infinteLoadMorePosts(postPage) {
                                        $.ajax({
                                            url: ENDPOINT + "/club/{{$club_slug}}?posts=" + postPage,
                                            datatype: "html",
                                            type: "get",
                                            beforeSend: function () {
                                                $('.auto-load').show();
                                            }
                                        })
                                            .done(function (response) {
                                                if (response.length == 0) {
                                                    $('.auto-load').html("No more posts.");
                                                    return;
                                                }
                                                $('.auto-load').hide();
                                                $("#data-wrapper").append(response);
                                            })
                                            .fail(function (jqXHR, ajaxOptions, thrownError) {
                                                console.log('Server error occured');
                                            });
                                    }

                                    function infinteLoadMoreArticles(articlePage) {
                                        $.ajax({
                                            url: ENDPOINT + "/club-articles-fetch/{{$club->id}}?articles=" + articlePage,
                                            datatype: "html",
                                            type: "get",
                                            beforeSend: function () {
                                                $('.auto-load2').show();
                                            }
                                        })
                                            .done(function (response) {
                                                if (response.length == 0) {
                                                    $('.auto-load2').html("No more articles.");
                                                    return;
                                                }
                                                $('.auto-load2').hide();
                                                $("#data-wrapper2").append(response);
                                            })
                                            .fail(function (jqXHR, ajaxOptions, thrownError) {
                                                console.log('Server error occured');
                                            });
                                    }

                                    function infinteLoadMoreEvents(eventPage) {
                                        $.ajax({
                                            url: ENDPOINT + "/club-events-fetch/{{$club->id}}?events=" + eventPage,
                                            datatype: "html",
                                            type: "get",
                                            beforeSend: function () {
                                                $('.auto-load3').show();
                                            }
                                        })
                                            .done(function (response) {
                                                if (response.length == 0) {
                                                    $('.auto-load3').html("No more events.");
                                                    return;
                                                }
                                                $('.auto-load3').hide();
                                                $("#data-wrapper3").append(response);
                                            })
                                            .fail(function (jqXHR, ajaxOptions, thrownError) {
                                                console.log('Server error occured');
                                            });
                                    }

                                </script>

@endsection


