@auth
    @if(auth()->user()->admin == 1)

        <form action="store" method="POST">
            @csrf
                        <label for="assignCourse">Give Existing Course</label>
                        <select name="assignCourse" id="AssignCourse">
                            <option value="none">None</option>
                            @foreach($courses as $course)
                                <option value="{{$course['id']}}">{{$course['course_name']}}</option>
                            @endforeach
                        </select>

            <button>Add Course to Teacher</button>
        </form>

    @else
        <p>You are not admin</p>
    @endif

@endauth


