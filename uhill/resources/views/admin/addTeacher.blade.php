@auth
    @if(auth()->user()->admin == 1)

        <form action="/teacher/store" method="POST">
            @csrf
            <h1>Add new teacher</h1>
            <label for="name">Name</label>
            <input id="name" type="text" name="name"
                   value="{{old('name')}}">
            @error('name')
            <p>{{$message}}</p>
            @enderror

            <label for="bio">Description</label>
            <input id="bio" type="text" name="bio"
                   value="{{old('bio')}}">

            @error('bio')
            <p>{{$message}}</p>
            @enderror
            <button>Add Teacher</button>
        </form>


    @else
        <p>You are not admin</p>
    @endif
@endauth


