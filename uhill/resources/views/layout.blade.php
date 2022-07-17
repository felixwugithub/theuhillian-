<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rate My Uhill</title>
    @vite('resources/css/app.css')


</head>
<body class="bg-red-100">

<div>
<h1 class="text-2xl">Rate My Uhill</h1>
<a href="/">All Courses</a>
<a href="/teachers">Teachers</a>
</div>

@auth
    <a href="/profile/{{auth()->user()->id}}">My Profile</a>
@endauth

<p>Test Paragraph</p>

@auth
    <h3>Welcome {{auth()->user()->username}}</h3>

    <form method="POST" action="/logout">
        @csrf
        <button class="bg-blue-200 text-white font-bold py-2 px-4 rounded hover:bg-blue-400" type="submit">Logout</button>
    </form>

@else
    <a href="/register">register</a>
    <a href="/login">login</a>
@endauth


@auth
    @if(auth()->user()->admin == 1)
        <a href="/teacher/create">Create Teacher</a>
    @endif
@endauth

@yield('content')

</body>
</html>
