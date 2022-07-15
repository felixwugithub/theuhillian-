@extends('layout')

@section('content')

    @auth

        @if(auth()->user('id') == $id)

            <form action="/profile/{{ $id }}/ " method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')




            </form>

        @endif

    @endauth

@endsection
