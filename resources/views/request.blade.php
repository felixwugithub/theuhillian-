@extends('layout')

@section('content')

    <div class="w-full md:w-7/12 bg-felixSalmon rounded-3xl h-auto m-5 p-5 justify-center mx-auto">

        <h2 class="text-4xl font-ooga text-spicyPink text-center mx-auto justify-center">Request to add a course </h2>
        <p class="text-center font-comfortaa text-hotPink">Our admins will manually review your request within 48 hours.</p>

        <form action="/course-request-store" method="POST">
            @csrf

            <div class="relative z-0 my-6 w-full group font-ooga">
                <input type="text" name="name" id="name" class="block pt-2.5 pb-1 px-0 w-full text-2xl text-notRealBlack font-readex text-gray-900 bg-transparent border-0 border-b-2 border-hotPink appearance-none dark:text-white dark:border-gray-600 dark:focus:border-hotPink focus:outline-none focus:ring-0 focus:border-spicyPink peer" value="{{old('name')}}" required />
                <label for="name" class="peer-focus:font-medium absolute text-lg text-hotPink hotPink-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-100 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-spicyPink peer-focus:dark:text-hotPink peer-placeholder-shown:scale-120 peer-placeholder-shown:translate-y-0 peer-focus:scale-125 peer-focus:-translate-y-6">Course Name</label>
            </div>

            <div class="flex-none space-y-5 lg:space-y-0 lg:flex font-ooga text-hotPink text-lg mb-5">
                <div class="w-full lg:w-[50%] justify-between lg:justify-start flex items-center">
                    <label for="teacher_name">Teacher: </label>
                    <input id="teacher_name" type="text" name="teacher_name" class="w-1/2 h-8 rounded-lg bg-pinkie border-0 focus:border-5 focus:ring-hotPink focus:border-felixSalmon mx-5"
                           value="{{old('teacher_name')}}" required>
                </div>

                <div class="w-full lg:w-[25%] justify-between lg:justify-start flex items-center">
                    <label for="room_number">Room: </label>
                    <input id="room_number" type="text" name="room_number" class="w-1/2 h-8 rounded-lg bg-pinkie border-0 focus:border-5 focus:ring-hotPink focus:border-felixSalmon mx-5"
                           value="{{old('room_number')}}">
                </div>

                <div class="w-full lg:w-[25%] justify-between lg:justify-start flex items-center">
                    <label for="code">Course Code: </label>
                    <input id="code" type="text" name="code" class="w-1/2 h-8 rounded-lg bg-pinkie border-0 focus:border-5 focus:ring-hotPink focus:border-felixSalmon mx-5"
                           value="{{old('code')}}" required>
                </div>
            </div>

            <label for="grade" class="block mb-2 text-lg text-hotPink hotPink-500 font-slim">Grade</label>
            <select id="grade" name="grade" class="bg-gray-50 border border-hotPink text-lg text-hotPink rounded-lg focus:ring-spicyPink block w-full p-2.5" required>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>

            @error('grade')
            <p>{{$message}}</p>
            @enderror


            <div class="font-ooga text-spicyPink">
                <div class="mt-10 w-full">
                    <label for="description" class="w-full mx-auto text-center font-ooga text-hotPink text-lg">Description: <br> </label>
                    <label for="description" class="w-full mx-auto text-center font-ooga text-hotPink text-sm">Be creative. Your description might end up in the course page! </label>
                    <textarea id="description" name="description" class="w-full align-top items-start h-64 bg-pinkie border-0 focus:border-5 focus:ring-hotPink focus:border-felixSalmon p-5" maxlength="512" minlength="10" required></textarea>
                </div>
            </div>

            <button class="px-3 py-1 bg-spicyPink rounded-md text-white mt-3 ml-3 mx-auto justify-center">Send Request</button>
            <p class="text-xs font-slim text-hotPink flex ml-3 mt-3">Double check your request! You can only submit ONE course request every day. </p>


        </form>

    </div>

@endsection