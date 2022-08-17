@extends('layout')
@section('content')

    <div class="w-full h-full items-center justify-center mx-auto bg-ripeBanana p-5">


        <form action="{{route('articlePDFUpload')}}" enctype="multipart/form-data" method="post">
        @csrf
        @method('POST')


        <div>
        <label for="title">Title</label>
        <input id="title" type="text" name="title"
               value="{{old('title')}}">
        @error('title')
        <p>{{$message}}</p>
        @enderror
        </div>

        <br>

        <div>
        <label for="author">Author</label>
        <input id="author" type="text" name="author"
               value="{{old('author')}}">

        @error('author')
        <p>{{$message}}</p>
        @enderror
        </div>
        <br>

        <div>

            <input id="x" type="hidden" name="content">
            <trix-editor class="trix-editor" input="x"></trix-editor>



            @error('content')
            <p>{{$message}}</p>
            @enderror
        </div>

        <br>
        <div>
        <label for="pdf">PDF</label>
        <input type="file" name="pdf" id="pdf">
        @error('pdf')
        <p>{{$message}}</p>
        @enderror
        </div>
        <br>

        <button>Add Article</button>

    </form>

    </div>

@endsection
