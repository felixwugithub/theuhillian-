@extends('layout')

@section('content')

  <div class="flex flex-col justify-center items-center h-11/12">
      <div class="w-96 mt-6 px-10 py-10 bg-felixSalmon rounded-lg justify-center shadow-md overflow-hidden">

<form method="POST" action="/users">
    @csrf

    <label for="name" class="block mt-5 font-slim">Username</label>
    <input class="mt-5 input1 rounded-full h-7" type="text" name="username" value="{{old('username')}}">
    @error('username')
    <p class="text-xs text-hotPink">{{$message}}</p>
    @enderror

    <lable for="email" class="block mt-5 font-slim">Email</lable>
    <input class="mt-5 input1 rounded-full" type="email" name="email" value="{{old('email')}}">
    @error('email')
    <p class="text-xs text-hotPink">{{$message}}</p>
    @enderror

    <lable for="password" class="block mt-5 font-slim">Password</lable>
    <input class="mt-5 input1 rounded-full"  type="password" name="password">
    @error('password')
    <p class="text-xs text-hotPink">{{$message}}</p>
    @enderror

    <lable for="password_confirmation font-slim" class="block mt-5 font-slim">Password Confirmation</lable>
    <input class="mt-5 input1 rounded-full" type="password" name="password_confirmation">
    @error('password_confirmation')
    <p class="text-xs text-hotPink">{{$message}}</p>
    @enderror


    <button type="submit" class="items-center block bg-hotPink text-white font-slim rounded hover:bg-pink-500 mt-5 p-0.5">Register</button>


</form>


  </div>
@endsection
