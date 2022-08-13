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



    {{$club['name']}}

    <div>
        @if(!$club->clubJoined(auth()->user()))
            <a href="{{route('joinClub', ['id' => $club->id])}}"> Join this club </a>
        @else
            <a href="{{route('quitClub', ['id' => $club->id])}}"> Quit this club </a>
        @endif
    </div>



@endsection


