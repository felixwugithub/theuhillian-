@extends('layout')

@section('content')

    <div class="flex flex-col justify-center items-center h-1/3 ">
    <div class="w-96 mt-6 px-10 py-10 bg-felixSalmon rounded-lg justify-center shadow-md overflow-hidden">
        <form method="POST" action="/users/authenticate">
    @csrf
    <lable for="email" class="block mt-5 font-slim">Email</lable>
    <input class="mt-5 input1 rounded-full" type="email" name="email" value="{{old('email')}}">
    @error('email')
    <p class="text-xs text-hotPink">{{$message}}</p>
    @enderror

    <lable for="password" class="mt-5 block font-slim">Password</lable>
    <input  class="mt-5 input1 rounded-full" type="password" name="password">
    @error('password')
    <p class="text-xs text-hotPink">{{$message}}</p>
         @enderror
            <button class="block bg-hotPink text-white font-slim rounded hover:bg-pink-500 mt-5 p-0.5" type="submit">Login</button>
        </form>
    </div>
    </div>

@endsection
