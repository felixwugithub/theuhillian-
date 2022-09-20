@extends('layout')

@section('content')

    <h1 class="text-3xl font-ooga text-center">
        You're reporting:
    </h1>

<div class="bg-felixSalmon m-5 p-5 b-5 relative container w-auto mx-auto" id="review{{$review->id}}" >

    <!-- <svg class="h-0.7 w-80 m-auto box-shadow mb-3"><rect class="w-80 h-1 rounded-3 m-auto "></rect></svg>
    -->
    <h1 class="text-3xl text-center md:text-center font-quicksand-regular">{{$review['title']}}</h1>

    <div id="reviewBlock{{$review->id}}" class="text-center">
        <a class="font-didact hover:text-hotPink" href="../profile/{{$review->user['id']}}"> from <span class="text-xl text-hotPink"> {{$review->user['username']}} </span> </a>
    </div>



    <p class="m-4 text-l font-sans mt-3">{{$review['content']}}</p>



    <ul class=" text-gray-600 font-medium text-center rounded-lg divide-x divide-white sm:flex mt-6 mb-3">
        <li class="w-full text-center">
            <h5>Personality: {{$review['personality']}}/10</h5>
            <img src="/images/star-ratings/{{$review['personality']}}.png" alt="" class="w-48 h-8 mx-auto hidden md:block">
        </li>
        <li class="w-full">
            <h5>Fairness: {{$review['fairness']}}/10</h5>
            <img src="/images/star-ratings/{{$review['fairness']}}.png" alt="" class="w-48 h-8 mx-auto hidden md:block">
        <li class="w-full">
            <h5>Content Coverage: {{$review['content_coverage']}}/10</h5>
            <img src="/images/star-ratings/{{$review['content_coverage']}}.png" alt="" class="w-48 h-8 mx-auto hidden md:block">
        </li>

    </ul>


    <div class="w-full flex justify-center">

        <div class=" text-center justify-center w-36 h-15 rounded-2xl m-2 border-2 border-hotPink container xl:top-2 xl:right-2 xl:absolute xl-auto">
            <p class="text-hotPink  font-ooga">" Difficulty:</p>
            <h1 class="text-4xl font-slim text-spicyPink">{{$review['difficulty']}}</h1>
            <h1 class="font-ooga text-hotPink bottom-1 right-2 xl:absolute">/10 "</h1>
        </div>

    </div>

    <div class="text-xs text-gray-500 font-comfortaa text-center mt-3">

        @if($review['created_at'] != $review['updated_at'])

            <p> (edited at {{$review['updated_at']}})</p>

        @else

            <p> {{$review['created_at']}}</p>

        @endif

    </div>


    <div class="justify-center flex w-full">

        <form action="/review-report-store/{{$review->id}}">
            <div class="rounded-2xl bg-felixSalmon mt-10">
                <label for="description" class="font-comfortaa text-xl text-spicyPink">Reason for report: </label>

                <div>
                <textarea minlength="2" maxlength="512" name="description" id="description" class="w-full text-xl font-ooga text-spicyPink bg-pinkie focus:ring-hotPink focus:border-hotPink" cols="30" rows="10" required>
                </textarea>
                </div>

            </div>

            <button class="bg-hotPink hover:bg-spicyPink text-white rounded-xl p-1" type="submit"> Submit Report </button>
        </form>
    </div>

</div>



@endsection