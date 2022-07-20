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

<nav class="relative container mx-auto px-2 py-5 sticky top-0 bg-white">
<div class="max-w-screen-xl mx-auto px-5 flex items-center justify-between">

    <div class="flex-nowrap">

        <div class="float-left">
        <img src="/images/uhillLogoBnW.jpeg" class="h-10 w-10 inline-flex" alt="Logo">
        </div>

        <div class="float-right">
            <h1 class="font-sansMid text-4xl">Rate My Uhill</h1>
        </div>
    </div>


    <div class="relative hidden lg:flex lg:items-center grid place-items-center mr-16 pr-2">
        <a href="/" class="hover:text-hotPink text-lg text-notRealBlack font-slim px-8">Courses</a>
        <a href="/teachers" class="hover:text-hotPink text-notRealBlack text-lg font-slim px-8">Teachers</a>
    </div>

    <div class="hidden md:flex items-center ml-16">

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
