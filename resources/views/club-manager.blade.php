@extends('layout')

@section('content')

    <h1>here is where you can edit details about your club. Apologies for the ugly UI, the devs are behind schedule</h1>

    <h2>What would you like to do?</h2>

    <a href="{{route('club-magazine-manager', ['id' => $club->id])}}"> Manage Articles</a>

    <div class="m-5 p-5 rounded-2xl bg-blue-50 space-x-4">

        @if(session()->get('updated'))
            <div class="green-200">
                <p class="text-sm">Club Info Updated Successfully.</p>
            </div>
        @endif

        <div class="flex justify-center mx-auto">

            @if(isset($club->club_cover_image->image))
            <div>
                <p class="mx-64">current cover photo</p>
                <img class="w-11/12 h-56 object-cover overflow-hidden" src="/storage/clubCoverImages/{{$club->club_cover_image->image}}" alt="">
            </div>
            @endif
            
            
            <form action="{{route('club-cover-store', ['club_id' => $club->id])}}" method="post" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="images">Upload Images</label>
                <input class="block  text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image" name="cover_image" type="file">
                <button type="submit" class="m-5 p-3 rounded-2xl bg-blue-100"> Update Club Cover Photo</button>
            </form>
        </div>



        <form action="{{route('club-info-update', ['id' => $club->id])}}" class="space-y-10 items-center">
            @csrf
            @method('post')

            <div>
                <label for="club-name">Club Name</label>
                @error('name')
                <p>{{$message}}</p>
                @enderror
                <input maxlength="128" type="text" class="w-full" id="name" name="name" value="{{old('name', $club->name)}}" required>

            </div>

            <div>
                <label for="description">Description</label>
                @error('description')
                <p>{{$message}}</p>
                @enderror

                <textarea maxlength="512" id="description" name="description" class="h-36 w-full"> {{old('description', $club->description)}} </textarea>

            </div>

            <div class="flex space-x-4 justify-between">

                <label for="president">President: </label>
                @error('president')
                <p>{{$message}}</p>
                @enderror
                <input maxlength="512" id="president" name="president" class="w-1/3" value="{{old('president', $club->president)}}">



                <label for="description">Vice President</label>
                @error('vice_president')
                <p>{{$message}}</p>
                @enderror
                <input maxlength="30" id="vice_president" name="vice_president" class="w-1/3" value="{{old('vice_president', $club->vice_president)}}">

            </div>

            <div class="flex justify-around">

                <div>
                    <label for="room_number">Room Number</label>
                    @error('room_number')
                    <p>{{$message}}</p>
                    @enderror

                    <input maxlength="30" class="w-full" type="text" id="room_number" name="room_number" value="{{old('room_number', $club->room_number)}}">

                </div>

                <div>
                    <label for="meeting_times">Meeting Times</label>
                    @error('meeting-times')
                    <p>{{$message}}</p>
                    @enderror
                    <input maxlength="36" class="w-full" type="text" id="meeting_times" name="meeting_times" value="{{old('meeting_times', $club->meeting_times)}}">

                </div>

            </div>

            <div>
                <label for="url">Website URL (<span class="font-bold">https</span>://example.com)</label>
                @error('url')
                <p>{{$message}}</p>
                @enderror

                <input maxlength="150" class="w-full" type="url" name="url" id="url"
                       pattern="https://.*" size="30" value="{{old('url',$club->url)}}">
            </div>

            <button type="submit">Update</button>

        </form>
    </div>
@endsection