<!doctype html>
<html lang="en">
<head>


    {{--Fonts--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200;300;325;350&family=Public+Sans:wght@800&family=Work+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">



    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">

    <!-- if production -->


    <?php
    $file = json_decode(file_get_contents(base_path().'/public/build/manifest.json'), true);
    ?>

{{--    <link rel="stylesheet" href="/build/{{$file['resources/css/app.css']['file']}}" />--}}
{{--    <script type="module" src="/build/{{ $file['resources/js/app.js']['file'] }}"></script>--}}


    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>The Uhillian</title>


    @livewireStyles

    @vite('resources/css/app.css')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="/js/trix.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/js/jquery.jscroll.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <x-rich-text-trix-styles></x-rich-text-trix-styles>

</head>



<body class="overflow-visible" id="content">

<nav class="relative w-screen max-w-[4000px] container md:px-2 md:py-5 md:sticky top-5 md:top-0 bg-white md:overflow-hidden h-20 md:h-auto z-50 flex">

<div class="md:hidden right-2 top-2 absolute mx-auto">

    <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation" class="flex font-slim" type="button"> Menu <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>

    <!-- Dropdown menu -->
    <div id="dropdownInformation" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
        @auth<div class="py-3 px-4 text-sm text-gray-900 dark:text-white">

                <a class="font-slim pr-5 hover:text-hotPink" href="/profile/{{auth()->user()->id}}">Welcome, {{auth()->user()->username}}!</a>

        </div>
        @endauth
        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownInformationButton">
            <li>
                <a href="/dashboard" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
            </li>
            <li>
                <a href="/clubs" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Clubs</a>
            </li>
            <li>
                <a href="/" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Courses</a>
            </li>
            <li>
                <a href="/magazine" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Magazine</a>
            </li>
        </ul>
        <div class="py-1">
            @if(!auth()->check())
                <a href="/register" class="font-slim hover:text-hotPink px-5">register</a>
                <a href="/login" class="font-slim hover:text-hotPink px-5">login</a>
            @else
            <a href="/logout" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Logout</a>
            @endif
        </div>
    </div>

</div>


    <div class="max-w-screen-xl w-full mx-auto pl-5 flex items-center md:justify-between my-0 ">

        <div class="flex-nowrap">
            <div class="float-left md:pt-0 items-center ">
                <a href="/"><img src="/images/uhillLogoBnW.jpeg" class="h-10 w-10 mx-2 inline-flex md:mt-0 " alt="Logo">
                <div class="float-right">
                    <h1 class="font-comfortaa hover:text-hotPink text-3xl md:ml-2 mt-1">The Uhillian</h1>


                </div>
                </a>
            </div>
        </div>


        <div class="relative lg:flex lg:items-center grid float md:pr-auto ml-2 hidden md:block">
            <a href="/magazine" class="hover:text-yellow-500  text-lg font-slim md:px-8">Magazine</a>
            <a href="/clubs" class="hover:text-blue-400  text-lg font-slim md:px-8">Clubs</a>
            <a href="/" class="hover:text-hotPink text-lg  font-slim md:px-8">Courses</a>
        </div>

        <div class=" sm:float-right  md:flex float-end right-0 hidden md:block">
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

        <div class="bg-blue-50 justify-content-around hidden md:block">
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
