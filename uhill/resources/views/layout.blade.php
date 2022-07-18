<!doctype html>
<html lang="en">
<head>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200;300&family=Public+Sans:wght@800&family=Work+Sans&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rate My Uhill</title>
    @vite('resources/css/app.css')

</head>
<body>

<nav class="relative container mx-auto p-4">
<div class="flex justify-evenly items-end">

    <div class="h-10 w-10">
        <img src="images/uhillLogoBnW.jpeg" alt="Logo">
    </div>

    <div class="hidden md:flex justify-center">
        <a href="/" class="hover:text-hotPink text-lg text-notRealBlack font-slim px-8">Courses</a>
        <a href="/teachers" class="hover:text-hotPink text-notRealBlack text-lg font-slim px-8">Teachers</a>
    </div>

    <div class="hidden md:flex items-center">

    @auth

            <a class="font-slim pr-5 hover:text-hotPink" href="/profile/{{auth()->user()->id}}">Welcome, {{auth()->user()->username}}!</a>
        <form method="POST" action="/logout" class="pb-1">
            @csrf
            <button class="bg-hotPink text-white font-slim rounded hover:bg-pink-500" type="submit">Logout</button>
        </form>
    @else
        <a href="/register" class="font-slim hover:text-hotPink px-5">register</a>
        <a href="/login" class="font-slim hover:text-hotPink ">login</a>
    @endauth
    </div>

</div>
</nav>


<div>


</div>


@auth
    @if(auth()->user()->admin == 1)
        <a href="/teacher/create">Create Teacher</a>
    @endif
@endauth

@yield('content')

</body>
</html>
