@extends('layout')

@section('content')



    <body onload="sortBy('rating')">
    <!-- Tab links -->
    <div class="tab">
        <button class="tablinks" onclick="sortBy('rating')"> Ranked by Rating </button>
        <button class="tablinks" onclick="sortBy('alphabetical')"> Alphabetical </button>
    </div>

    <!-- Tab content -->
    <div id="alphabetical" class="tabcontent">

        @foreach(\App\Models\Teacher::all()->sortBy('name') as $teacher)

            <div class="m-1 b-1 bg-pink-100 justify-content-center text-center">
            <h2>
                <a href="/teacher/{{$teacher['id']}}"> {{$teacher['name']}}</a>
            </h2>

            <h4>{{$teacher['overall']}} / 10 </h4>
            </div>

        @endforeach
    </div>

    <div id="rating" class="tabcontent">


        @foreach(\App\Models\Teacher::all()->sortBy('overall') as $teacher)

            <div class="m-1 b-1 bg-pink-100 justify-content-center text-center">
            <h2>
                <a href="/teacher/{{$teacher['id']}}"> {{$teacher['name']}}</a>
            </h2>

            <h4>{{$teacher['overall']}} / 10 </h4>
            </div>

        @endforeach
    </div>











    <script>

        function sortBy(order) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(order).style.display = "block";
            evt.currentTarget.className += " active";
        }

    </script>


@endsection

