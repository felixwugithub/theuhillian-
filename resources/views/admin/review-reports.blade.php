@extends('layout')

@section('content')
    <div>
        <p>
            {{session()->get('message')}}
        </p>
    </div>
    @foreach($reports as $report)
    <div class="bg-red-50 m-2 p-5">
        <p class="text-spicyPink text-2xl">{{$report->review->title}}</p>

        <p>{{$report->review->content}}</p>


        <p class="text-xs text-gray-700"> REPORTED USER: {{$report->review->user}}</p>

        <p class="text-xs text-pink-800">REPORTER : {{$report->user}}</p>

        <p>REASON FOR REPORT {{$report->description}}</p>


        <div class="space-x-6 mt-5">
            <a class="mt-5 bg-green-50 hover:bg-green-200 p-2" href="/admin/reject-review-report/{{$report->id}}">REJECT REPORT </a>
            <a class="mt-5 hover:bg-hotPink bg-felixSalmon p-2" href="/admin/review-report-warn/{{$report->id}}">DELETE AND WARN </a>
            <a class="mt-5 bg-spicyPink hover:bg-gray-800 hover:text-white p-2" href="/admin/review-report-ban/{{$report->id}}">BAN USER </a>
        </div>

    </div>

    @endforeach
    {{$reports->links()}}
@endsection