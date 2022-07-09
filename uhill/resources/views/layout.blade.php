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
<a href="/">Home</a>

@auth
    @if(auth()->user()->admin == 1)
        <a href="/teacher/create">Create Teacher</a>
    @endif
@endauth

@yield('content')

</body>
</html>
