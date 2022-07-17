<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rate My Uhill</title>
</head>
<body>

<h1>Rate My Uhill</h1>
<a href="/">All Courses</a>
<a href="/teachers">Teachers</a>

@auth
    <a href="/profile/{{auth()->user()->id}}">My Profile</a>
@endauth


@auth
    <h3 >Welcome {{auth()->user()->username}}</h3>

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Logout</button>
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
