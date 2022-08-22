@extends('layout')

@section('content')

    <div class="container">

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


        <div id="club-mast-head" class="justify-center text-center items-center py-3">
            <h1 class="text-6xl font-readex">{{strtoupper($club->name)}}</h1>
             @auth()
                 @if(auth()->user()->admin == 1)
                    <form action="{{route('club-cover-store', ['club_id' => $club->id])}}" method="post" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="images">Upload Images</label>
                        <input class="block  text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image" name="cover_image" type="file">
                        <button type="submit"> Update Club Cover Photo</button>
                    </form>
                @endif
            @endauth


            <div class="container mx-auto pt-3">

                @if(isset($club->president))
                    <p class="font-quicksand-regular">President: {{$club->president}}</p>
                @endif

                @if(isset($club->vice_president))
                    <p class="font-quicksand-regular">Vice President: {{$club->vice_president}}</p>
                @endif

            </div>
        </div>

        <div class="pt-3">
            <div id="club-description" class="container md:w-1/2 mx-auto py-7 px-14 rounded-xl bg-blue-50">
                <p>{{$club->description}}</p>
            </div>
        </div>



        <div class="mx-auto container md:w-7/12 mt-10">

            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center justify-content-around" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 rounded-t-lg border-b-2 text-blue-500" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Blog</button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Articles</button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Events</button>
                    </li>
                    <li role="presentation">
                        <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Info</button>
                    </li>
                </ul>
            </div>

            <div id="myTabContent">
                <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">


                        <div>
                    @if(auth()->check())
                        @if(auth()->user()->admin == 1)
                            <div class="flex mx-auto">
                            <button class="justify-center mx-auto flex-wrap items-center text-center text-sm p-2 rounded-xl bg-blue-50 hover:bg-white" onclick="showHideDiv('club-post-form')"> New Post
                                @error('caption')
                                <div>
                                <p class="text-red-800 m-auto">{{$message}}</p>
                                @enderror

                                @error('images')
                                <p class="text-red-800 m-auto" >{{$message}}</p>
                                @enderror
                                </div>
                            </button>
                            </div>
                            <form id="club-post-form" action="{{route('club-post-store',['club_id' => $club->id])}}" method="post" enctype="multipart/form-data" style="display: none">
                                @csrf
                                @method('POST')
                                <div class="mb-6">
                                    <label for="caption" class="block mb-2 text-gray-900 dark:text-gray-300">Caption</label>
                                    <input type="text" id="caption" name="caption" class="block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-100 focus:border-blue-100 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-200 dark:focus:border-blue-500">


                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="images">Upload Images</label>
                                    <input class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="images" name="images[]" type="file" multiple=true>


                                    <button type="submit" class="text-blue-800 mx-auto mt-3 justify-center flex bg-blue-50 hover:bg-yellow-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Post! </button>


                                </div>
                            </form>
                        @endif
                    @endif

                    @foreach($club->club_posts->sortByDesc('created_at') as $post)
                            <hr class="my-5">
                        <div>
                            <h1 class="text-xl max-w-96 max-h-96 overflow-hidden">{{$post->caption}}</h1>
                            <p class="text-xs text-gray-600">{{$post->created_at}}</p>
                            @if(isset($post->club_post_pictures))
                                @foreach($post->club_post_pictures as $image_object)
                                    <img class="mx-auto"  src="/storage/clubPostImages/{{$image_object->image}}" alt="image">
                                @endforeach
                            @endif
                        </div>
                    @endforeach

                </div>


                <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    Articles
                </div>
                <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                    Events
                </div>
                <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                    Info
                </div>
            </div>

        </div>


    </div>


    <div>
        @if(auth()->check())
            @if(!$club->clubJoined(auth()->user()))
                <a href="{{route('joinClub', ['id' => $club->id])}}"> Join this club </a>
            @else
                <a href="{{route('quitClub', ['id' => $club->id])}}"> Quit this club </a>
            @endif

        @else
            <p class="mt-10">Login to follow this club for events, news, and updates.</p>
        @endif
    </div>

    <script src="/js/parts.js"> </script>
@endsection


