@extends('layout')

@section('content')
<h1>
    Login
</h1>

<form method="POST" action="/users/authenticate">
    @csrf
    <lable>Email</lable>
    <input type="email" name="email" value="{{old('email')}}">
    @error('email')
    <p>{{$message}}</p>
    @enderror

    <lable>Password</lable>
    <input type="password" name="password">
    @error('password')
    <p>{{$message}}</p>
    @enderror
    <button type="submit">Login</button>
</form>

@endsection
