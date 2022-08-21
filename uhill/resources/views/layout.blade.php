<!doctype html>
<html lang="en">
<head>

    {{--Fonts--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200;300;325;350&family=Public+Sans:wght@800&family=Work+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.1/dist/flowbite.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="/css/trix.css">


    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>The Uhillian</title>

    @vite('resources/css/app.css')
    @livewireStyles


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="/js/trix.js"></script>

    <x-rich-text-trix-styles></x-rich-text-trix-styles>
</head>



<body class="overflow-visible" id="content">

<nav class="relative max-w-screen-xl w-full container md:px-2 md:py-5 md:sticky top-5 md:top-0 bg-white overflow-hidden h-20 md:h-auto z-50">

    <div class="max-w-screen-xl w-full mx-auto pl-5 flex items-center md:justify-between my-0 ">

        <div class="flex-nowrap">
            <div class="float-left md:pt-0 items-center ">
                <a href="/"><img src="/images/uhillLogoBnW.jpeg" class="h-10 w-10 inline-flex md:mt-0 " alt="Logo">
                <div class="float-right">
                    <h1 class="font-comfortaa hover:text-hotPink text-3xl md:ml-2 mt-1 hidden md:block">The Uhillian</h1>
                </div>
                </a>
            </div>
        </div>


        <div class="relative lg:flex lg:items-center grid float pr-14 md:pr-auto ">
            <a href="/magazine" class="hover:text-yellow-500  text-lg font-slim md:px-8">Magazine</a>
            <a href="/clubs" class="hover:text-blue-400  text-lg font-slim md:px-8">Clubs</a>
            <a href="/" class="hover:text-hotPink text-lg  font-slim md:px-8">Courses</a>
            <a href="/teachers" class="hover:text-hotPink  text-lg font-slim md:px-8">Teachers</a>
        </div>

        <div class=" sm:float-right  md:flex float-end right-0">
        @auth
                <a class="font-slim pr-5 hover:text-hotPink" href="/dashboard">Dashboard</a>
                <a class="font-slim pr-5 hover:text-hotPink" href="/profile/{{auth()->user()->id}}">Welcome, {{auth()->user()->username}}!</a>
            <form method="POST" action="/logout" class="pb-1">
                @csrf
                <button class="bg-hotPink text-white font-slim rounded hover:bg-pink-500" type="submit">Logout</button>
            </form>
        @else
            <a href="/register" class="font-slim hover:text-hotPink px-5">register</a>
            <a href="/login" class="font-slim hover:text-hotPink px-5">login</a>
        @endauth
        </div>

    </div>
</nav>


<div>


</div>



@auth
    @if(auth()->user()->admin == 1)

        <div class="bg-blue-50 justify-content-around">
        <a href="/admin/teacher/create">||Create Teacher||</a>
        <a href="/admin/course/create">Create Course</a>
        <a href="/admin/club/create">||Create a Club||</a>
        </div>
    @endif
@endauth

@yield('content')

<script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
@livewireScripts
</body>
</html>
