@extends('layout')
@section('content')

    @auth
        @if(Auth::id() == $id)



            <form action="/profile/{{ $id }}/ " method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{$name}}">
                @error('name')
                <p>{{$message}}</p>
                @enderror

                <label for="grade">Grade</label>
                <select name="grade" id="grade">
                    <option <?php if ($grade == 8) echo "selected";?> value="8">8</option>
                    <option <?php if ($grade == 9) echo "selected";?> value="9">9</option>
                    <option <?php if ($grade == 10) echo "selected";?> value="10">10</option>
                    <option <?php if ($grade == 11) echo "selected";?> value="11">11</option>
                    <option <?php if ($grade == 12) echo "selected";?> value="12">12</option>
                </select>
                @error('grade')
                <p>{{$message}}</p>
                @enderror

                <label for="description">Description</label>
                <input type="text" name="description" value="{{$description}}" id="description">
                @error('description')
                <p>{{$message}}</p>
                @enderror

                <label for="url">URL (https://example.com) </label>
                <input type="text" name="url" value="{{$url}}" id="url">
                @error('url')
                <p>{{$message}}</p>
                @enderror

                <button type="submit">Submit Changes</button>

            </form>

            @endif
    @endauth



@endsection
