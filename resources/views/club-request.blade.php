@extends('layout')

@section('content')

    <div class="w-full md:w-[77%] bg-blue-50 rounded-3xl h-auto m-5 p-5 justify-center mx-auto">

        <h2 class="text-4xl font-ooga text-blue-900 text-center mx-auto justify-center">Request to add a club </h2>
        <p class="text-center font-comfortaa text-blue-800">Our admins will manually review your request within 48 hours.</p>

        <form action="/club-request-store" method="POST">
            @csrf

            <div class="relative z-0 my-6 w-full group font-ooga">
                <input maxlength="64" minlength="2" type="text" name="name" id="name" class="block pt-2.5 pb-1 px-0 w-full text-2xl text-notRealBlack font-readex text-gray-900 bg-transparent border-0 border-b-2 border-blue-700 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-hotPink focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="{{old('name')}}" required />
                <label for="name" class="peer-focus:font-medium absolute text-lg text-blue-800 dark:text-gray-400 duration-300 transform -translate-y-6 scale-100 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500  peer-placeholder-shown:scale-120 peer-placeholder-shown:translate-y-0 peer-focus:scale-125 peer-focus:-translate-y-6">Club Name</label>
            </div>

            @error('name')
            <p>{{$message}}</p>
            @enderror

            <div class="flex-none space-y-5 lg:space-y-0 lg:flex font-ooga text-blue-500 text-lg mb-5">
                <div class="w-full lg:w-[25%] justify-between lg:justify-start flex items-center">
                    <label for="president">President: </label>
                    <input id="president" type="text" name="president" class="w-1/2 h-8 rounded-lg border-0 focus:border-5 focus:ring-blue-100 focus:border-blue-200 mx-5"
                           value="{{old('president')}}" maxlength="64" minlength="2" required>
                </div>

                <div class="w-full lg:w-[25%] justify-between lg:justify-start flex items-center">
                    <label for="vice_president">Vice President: </label>
                    <input id="vice_president" type="text" name="vice_president" class="w-1/2 h-8 rounded-lg border-0 focus:border-5 focus:ring-blue-100 focus:border-blue-200 mx-5"
                           value="{{old('vice_president')}}"  maxlength="64" minlength="2">
                </div>

                <div class="w-full lg:w-[25%] justify-between lg:justify-start flex items-center">
                    <label for="room_number">Room: </label>
                    <input id="room_number" type="text" name="room_number" class="w-1/2 h-8 rounded-lg border-0 focus:border-5 focus:ring-blue-100 focus:border-blue-200 mx-5"
                           value="{{old('room_number')}}" minlength="2" maxlength="50">
                </div>

                <div class="w-full lg:w-[25%] justify-between lg:justify-start flex items-center">
                    <label for="meeting_times">Meeting Times: </label>
                    <input id="meeting_times"  type="text" name="meeting_times" class="w-1/2 h-8 rounded-lg border-0 focus:border-5 focus:ring-blue-100 focus:border-blue-200 mx-5"
                           value="{{old('meeting_times')}}" maxlength="128" required>
                </div>
            </div>

            <div class="w-full justify-between lg:justify-start flex items-center font-ooga text-blue-500 text-lg">
                <label for="url">URL: </label>
                <input id="url"   pattern="https://.*" type="url" name="url" class="w-1/2 h-8 rounded-lg border-0 focus:border-5 focus:ring-blue-100 focus:border-blue-200 mx-5"
                       value="{{old('url')}}">
            </div>



            <div class="font-ooga text-blue-800">
                <div class="mt-10 w-full">
                    <label for="description" class="w-full mx-auto text-center font-ooga text-blue-500 text-lg">Description: <br> </label>
                    <textarea id="description" name="description" class="w-full align-top items-start h-64  border-0 focus:border-5 focus:ring-blue-200 focus:border-blue-400 p-5" maxlength="512" minlength="10" required></textarea>
                </div>
            </div>

            <button class="px-3 py-1 bg-blue-800 rounded-md text-white mt-3 ml-3 mx-auto justify-center">Send Request</button>
            <p class="text-xs font-slim text-blue-400 flex ml-3 mt-3">Double check your request! You can only submit ONE club request every day. </p>


        </form>

    </div>

@endsection