@auth
    @if(auth()->user()->admin == 1)
        <form action="/admin/teacher/store" method="POST">
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

            <label for="assignCourse">Give Existing Course</label>
            <select name="assignCourse" id="AssignCourse">
                @foreach($courses as $course)
                    <option value="{{$course['id']}}">{{$course['course_name']}}</option>
                @endforeach
            </select>




            <button>Add Teacher</button>



        </form>

    @else
        <p>You are not admin</p>
    @endif

@endauth


