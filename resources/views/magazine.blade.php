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

    <div class="container w-full mx-auto justify-center">
        <div class="w-full px-10 mb-10 md:pt-3 px-24 md:h-48 bg-rawBanana static">
            <h1 class="font-modern text-4xl md:text-7xl xl:text-9xl left-7 absolute">Digital Magazine</h1>
        </div>


        @foreach($articles as $article)

                <a href="{{route('article', ['title' => str_replace(' ', '_', $article->title)])}}">
        <div class="p-5 b-5 m-5 container w-auto bg-ripeBanana">
            <p>
                {{$article->title}}
            </p>
        </div>
                </a>
        @endforeach

            <div class="w-full md:w-1/2 justify-center items-center text-center">
        {{$articles->links()}}
            </div>

    </div>



@endsection
