
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

        - the clubs displayed on the current page, as array:    $clubs
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


    <div class="flex font-sf items-center justify-center mx-auto pt-5 space-x-2">
        <h1 class="md:mt-4 pb-5 ml-7 text-center text-notReallyBlack text-5xl ">Clubs</h1>
        <h1 class="md:mt-4 pb-5 ml-7 text-center text-notReallyBlack text-5xl hidden md:block">at University Hill Secondary
        </h1>
    </div>

    <div class="text-center justify-content-evenly mx-auto">
    <form action="/filterclubs" method="post" enctype="multipart/form-data" class="mx-auto">
        <div class="font-slim text-sm items-center">
       @csrf
            @method('POST')
                <label for="search"> Search for:</label>

                <input placeholder="leave blank for all" class="placeholder-blue-400 bg-blue-50 no-border rounded text-sm focus:ring-blue-600  mx-auto" type="text" id="search" name="search"

                       @if(isset($clubSearch))
                       value="{{$clubSearch}}"
                    @endif>
            </div>
            <br>
            <div class="pt-2 text-center justify-start ml-2 -mt-2">
                <button type="submit" class="bg-blue-300 text-white font-slim rounded hover:bg-blue-800 px-1 special">Filter</button>
            </div>

    </form>
    </div>

    <div class="flex flex-wrap align-content-center flex justify-center">
        @foreach ($clubs as $club)
            <a href="{{route('club', ['club_name' => str_replace(' ', '_',$club->name)])}}" class="text-center mx-auto">
            <div class="w-full h-96 m-3 rounded-3xl hover:rounded-lg box-shadow justify-center pt-10 container text-center md:w-[22rem] bg-gradient-to-br from-blue-300 via-blue-100 to-blue-50">
                @if(isset($club->club_cover_image))
                    <div class="m-auto flex justify-center items-center container top-2 relative">
                         <img class="overflow-hidden h-36 w-full object-cover" src="{{'storage/clubCoverImages/'.$club->club_cover_image->image}}" alt="image">
                    </div>
                @endif

                    <div class="justify-center mt-5 px-3">
                         <h1 class="font-bold text-2xl">{{$club->name}}</h1>
                            @if(isset($club->description))
                                <h2 class="pt-3 font-readex">{{substr($club->description, 0, 75)}}...</h2>
                            @endif
                    </div>


                    <div class="relative flex mb-5 justify-center justify-content-around space-x-5">
                        @if(isset($club->room_number))
                            <h2 class="pt-3 font-slim flex bottom-2 right-0">Room: {{substr($club->room_number, 0, 10)}}</h2>
                        @endif

                        @if(isset($club->meeting_times))
                            <h2 class="pt-3 font-slim flex">Day of week: {{substr($club->meeting_times, 0, 20)}}</h2>
                        @endif
                    </div>

            </div>
            </a>
        @endforeach

    </div>

    <div class="flex font-sansMid items-center justify-center mx-auto mb-10">
        @if(isset($paginatePage))
            {{$clubs->links()}}
        @endif

    </div>


@endsection



