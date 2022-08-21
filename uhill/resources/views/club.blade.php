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


        <div id="club-mast-head" class="justify-center text-center items-center pb-3">
            <h1 class="text-6xl font-readex">{{strtoupper($club->name)}}</h1>
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
                    Posts
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

@endsection


