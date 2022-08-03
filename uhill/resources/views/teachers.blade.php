@extends('layout')

@section('content')

    @foreach($teachers as $teacher)
        <h2>
            <a href="/teacher/{{$teacher['id']}}"> {{$teacher['name']}}</a>
        </h2>



    @endforeach

<div id="app">

    <app>

    </app>
</div>

    <script src="{{ mix('js/app.js') }}"></script>

@endsection

