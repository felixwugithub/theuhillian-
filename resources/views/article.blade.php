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



    </div>
@endsection
