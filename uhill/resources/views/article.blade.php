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
    <div class="container max-w-screen-xl w-11/12 h-[188rem] bg-rawBanana">
        <h1 class="text-6xl font-sf">
        {{$article->title}}
        </h1>

        {{$article->trixRichText}}

        <br>


{{--        @if(isset($article->articlepdf))--}}

{{--    <iframe class="w-full h-full overflow-hidden" src="/storage/articlePDFs/{{$article->articlepdf->pdf}}">Bruh</iframe>--}}
{{--            @endif--}}

    </div>
@endsection
