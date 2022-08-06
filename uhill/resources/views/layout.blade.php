<!doctype html>
<html lang="en">
<head>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200;300&family=Public+Sans:wght@800&family=Work+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.1/dist/flowbite.min.css" />

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Rate My Uhill</title>
    @vite('resources/css/app.css')
    <script src="dist/flowbite.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body class="overflow-visible" id="content">

<nav class="relative container mx-auto md:px-2 md:py-5 sticky top-0 bg-white h-50 md:h-4">
<div class="max-w-screen-xl mx-auto px-5 flex items-center justify-between">

    <div class="flex-nowrap">

        <div class="float-left">
            <a href="/"><img src="/images/uhillLogoBnW.jpeg" class="h-10 w-10 inline-flex mt-10 md:mt-0" alt="Logo">
            <div class="float-right">
                <h1 class="font-comfortaa hover:text-hotPink text-4xl invisible md:visible">Rate My Uhill</h1>
            </div>
            </a>
        </div>


    </div>


    <div class="relative lg:flex lg:items-center grid place-items-center md:mr-16 md:pr-2">
        <a href="/" class="hover:text-hotPink text-lg text-notRealBlack font-slim md:px-8">Courses</a>
        <a href="/teachers" class="hover:text-hotPink text-notRealBlack text-lg font-slim md:px-8">Teachers</a>
    </div>

    <div class=" md:flex items-center md:ml-16 ">
    @auth

            <a class="font-slim pr-5 hover:text-hotPink" href="/profile/{{auth()->user()->id}}">Welcome, {{auth()->user()->username}}!</a>
        <form method="POST" action="/logout" class="pb-1">
            @csrf
            <button class="bg-hotPink text-white font-slim rounded hover:bg-pink-500" type="submit">Logout</button>
        </form>
    @else
        <a href="/register" class="font-slim hover:text-hotPink px-5">register</a>
        <a href="/login" class="font-slim hover:text-hotPink px-5 ">login</a>
    @endauth
    </div>

</div>
</nav>


<div>


</div>


@auth
    @if(auth()->user()->admin == 1)
        <a href="/admin/teacher/create">Create Teacher</a>
        <a href="/admin/course/create">Create Course</a>
    @endif
@endauth

@yield('content')


<script src="dist/flowbite.js"></script>
<script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
</body>
</html>
