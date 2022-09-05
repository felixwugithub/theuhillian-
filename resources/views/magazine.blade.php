@extends('layout')
@section('content')
<div class="bg-paper">
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

    <div class=" w-full max-w-[4000px] justify-center bg-paper lg:flex items-center lg:space-x-5 pt-12 lg:pt-0">

        <div class="mr-3 pt-1 lg:mt-0 text-md lg:text-xl text-center lg:text-left">
            <h2 class="font-paper-thin">{{\Illuminate\Support\Carbon::now()->format("l  F j, Y")}}</h2>
        </div>

        <h1 class="font-paper text-5xl lg:text-7xl mt-3 md:mt-2 text-center">Uhill's Digital Magazine</h1>

        <div class="w-full lg:w-48 h-44 text-sm overflow-hidden container scale-75 bg-paper" >
            <a class="weatherwidget-io" href="https://forecast7.com/en/49d28n123d12/vancouver/" data-label_1="VANCOUVER" data-label_2="WEATHER" data-font="Times New Roman" data-icons="Climacons Animated" data-mode="Current" data-days="3" data-theme="beige" data-basecolor="#fef7ea" data-accent="rgba(61, 60, 45, 0.03)" data-textcolor="#392727" data-highcolor="" data-lowcolor="" data-suncolor="" data-mooncolor="" data-cloudcolor="" data-cloudfill="" data-raincolor="" data-snowcolor="" >VANCOUVER WEATHER</a>
            <script>
                !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
            </script>
        </div>
    </div>


    <div class="bg-paper justify-center mx-auto w-full place-content-center">
        <div class="w-11/12 bg-black h-[1px] mb-1 mx-auto"></div>
        <div class="w-11/12 bg-black h-[1px] mb-3 lg:mb-5 mx-auto"></div>
    </div>

    <div class="container w-full max-w-[4000px] bg-paper justify-center">
        <div class="md:flex-wrap md:justify-evenly mx-auto space-y-3 md:w-[85%] p-5">
        @foreach($articles as $article)
            <div class="justify-around p-5 w-full">
                <a href="/magazine/article/{{str_replace(' ', '_', $article->title)}}">
                    <div class="justify-around bg-paper border-t-1 border-b-1 border-notRealBlack lg:w-[75%] md:h-64 flex-none md:flex mx-auto">

                        <div class="content-between lg:w-7/12 pr-5 container relative pb-10 lg:pb-0">

                           <div>
                               <h1 class="font-paper-thin text-3xl">{{substr($article->title, 0, 128)}}</h1>
                                <p class="font-didact text-lg">{{$article->author}}</p>
                           </div>


                            <div class="flex absolute bottom-0">
                                <p class="text-sm text-gray-500 font-comfortaa">
                                    {{$article->published_at}}
                                </p>
                            </div>

                        </div>

                        @if(isset($article->cover->image))
                        <img class="lg:w-5/12 md:w-[33%] h-full object-cover" src="/storage/articleCovers/{{$article->cover->image}}" alt="">
                        @endif

                    </div>
                </a>
            </div>

            <div class="mx-auto w-11/12 lg:w-[75%] h-[1px] bg-black"> </div>

        @endforeach
        </div>

        <div class="justify-center w-1/2 mx-auto py-12">
          <p>{{$articles->links()}}</p>
        </div>

    </div>




    <div>

@endsection
