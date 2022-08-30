@extends('layout')

@section('content')

    <p>Please tolerate the presently crude user interface, the one guy coding this site really needs some rest.</p>

    <div class="bg-blue-50 rounded-2xl m-5 p-10 container relative">
        <div class="items-center flex justify-between">
        <p class="justify-center">Articles: </p>
            <a href="/club-magazine-editor/{{$club->id}}">
            <div class="rounded-2xl w-48 p-2 bg-white hover:bg-blue-700 hover:text-blue-50 text-center">
                Write a new article
            </div>
            </a>

        </div>
        <div class="h-[30rem] overflow-scroll">
        @foreach($articles->sortByDesc('updated_at') as $article)
            <div class="bg-blue-50 flex justify-between items-center w-full bg-white/30 rounded-lg p-3 my-4 mx-auto">
                <div>
                    <p class="text-lg">{{$article->title}}</p>
                </div>



                <div class="flex space-x-5">
                    <a href="/club-magazine-editor/{{$club->id}}/{{$article->id}}">
                        Edit
                    </a>

                    @if(!$article->published)
                    <a href="/club-magazine-publish/{{$article->id}}">
                        Publish
                    </a>
                    @endif


                @if($article->published)
                <p class="text-green-500 w-24 pr-4">published</p>
                @else
                <p class="text-red-500 w-24 pr-4">unpublished</p>
                @endif
                </div>
            </div>
        @endforeach
        </div>
    </div>

@endsection
