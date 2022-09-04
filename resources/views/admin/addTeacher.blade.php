@auth
    @if(auth()->user()->admin == 1)

        <form action="/admin/teacher/store" method="POST">
            @csrf
            <h1>Add new teacher</h1>
            <label for="name">Nickname</label>
            <input id="name" type="text" name="name"
                   value="{{old('name')}}">
            @error('name')
            <p>{{$message}}</p>
            @enderror

            <label for="real_name">Real name:</label>
            <input id="real_name" type="text" name="real_name"
                   value="{{old('real_name')}}">

            @error('real_name')
            <p>{{$message}}</p>
            @enderror


            <button>Add Teacher</button>

        </form>

    @else
        <p>You are not admin</p>
    @endif

@endauth


