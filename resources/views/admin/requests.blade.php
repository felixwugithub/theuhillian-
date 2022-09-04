@extends('layout')

@section('content')

    @foreach($requests->where('closed', false) as $request)
    <div class="m-2 p-2 bg-slate-100">
        <h1 class="text-xl">{{$request->name}}</h1>
        <p>teacher: {{$request->teacher_name}}</p>
        <p>Accepted (0==false, 1==true): {{$request->accepted}}</p>
        <a class="text-hotPink" href="/admin/course-request-review/{{$request->id}}"> Make Decision</a>
        <p class="text-sm text-gray-300">{{$request->created_at}}</p>


        <div>
            <h1>User: {{$request->user->username}}</h1>
            <h1>User: {{$request->user->email}}</h1>
        </div>
    </div>
    @endforeach


    {{$requests->links()}}
@endsection