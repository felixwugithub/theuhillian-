@extends('layout')

@section('content')



    <div class="w-7/12 bg-felixSalmon rounded-3xl h-full m-5 p-5 justify-center mx-auto">

    <h2 class="text-4xl font-ooga text-spicyPink text-center mx-auto justify-center">You are reviewing {{$course['course_name']}}</h2>

    <form action="/course/{{$course['id']}}" method="POST">
        @csrf


        <div class="relative z-0 my-6 w-full group font-ooga">

            <input type="text" name="title" id="title" class="block pt-2.5 pb-1 px-0 w-full text-2xl text-notRealBlack font-readex text-gray-900 bg-transparent border-0 border-b-2 border-hotPink appearance-none dark:text-white dark:border-gray-600 dark:focus:border-hotPink focus:outline-none focus:ring-0 focus:border-spicyPink peer" placeholder=" " required />
            <label for="title" class="peer-focus:font-medium absolute text-lg text-hotPink hotPink-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-100 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-spicyPink peer-focus:dark:text-hotPink peer-placeholder-shown:scale-120 peer-placeholder-shown:translate-y-0 peer-focus:scale-125 peer-focus:-translate-y-6">Review Title</label>

        @error('title')
        <p>{{$message}}</p>
        @enderror

        </div>



        <div class="w-full flex justify-content-around font-ooga text-spicyPink">

            <div class="w-1/3">
                <label for="personality">Personality</label>
                <input id="personality" type="number" name="personality" class="w-14 h-8 rounded-[20%] bg-pinkie border-0 focus:border-5 focus:ring-hotPink focus:border-felixSalmon"
                       value="{{old('personality')}}">
                @error('personality')
                <p>{{$message}}</p>
                @enderror
            </div>

            <div class="w-1/3">
                <label for="fairness">Fairness</label>
                <input id="fairness" type="number" name="fairness" class="w-14 h-8 rounded-[20%] bg-pinkie border-0 focus:border-5 focus:ring-hotPink focus:border-felixSalmon"
                       value="{{old('fairness')}}">

                @error('fairness')
                <p>{{$message}}</p>
                @enderror
            </div>

            <div class="w-1/3">
            <label for="easiness">Easiness</label>
            <input id="easiness" type="number" name="easiness" class="w-14 h-8 rounded-[20%] bg-pinkie border-0 focus:border-5 focus:ring-hotPink focus:border-felixSalmon"
                   value="{{old('easiness')}}">

            @error('easiness')
            <p>{{$message}}</p>
            @enderror
            </div>
        </div>


        <div class="mt-10 w-full">

            <label for="content" class="w-full mx-auto text-center font-ooga text-spicyPink text-lg">Write your full review here: </label>
            <textarea id="content" name="content" class="w-full align-top items-start h-64 bg-pinkie border-0 focus:border-5 focus:ring-hotPink focus:border-felixSalmon p-5"></textarea>

            @error('content')d
            <p>{{$message}}</p>
            @enderror

        </div>
        <button class="px-3 py-1 bg-spicyPink rounded-md text-white mt-3 ml-3">Add Review</button>

    </form>

    </div>

@endsection
