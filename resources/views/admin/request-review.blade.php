@extends('layout')

@section('content')

    <div class="flex justify-between m-10 p-10">
        <div class="w-1/2 space-y-4">
            <h1>name: {{$request->name}}</h1>
            <p>Teacher: {{$request->teacher_name}}</p>
            <p>Description: {{$request->description}}</p>
            <p>Grade: {{$request->grade}}</p>
            <p>Room: {{$request->room_number}}</p>
            <p>code {{$request->code}}</p>
            <p>Accepted: {{$request->accepted}}</p>
            <p>Closed: {{$request->closed}}</p>

            <div class="h-96 overflow-scroll bg-pink-50">

                <h1 class="text-2xl">Check Existing Courses</h1>
                @foreach($courses as $course)
                    <div class="m-1 p-2">
                        <p class="text-xl text-spicyPink">{{$course->course_name}}</p>
                        <p>{{$course->teacher->name}}</p>
                        <p>{{$course->grade}}</p>
                        <p>{{$course->code}}</p>
                    </div>

                @endforeach
            </div>

        </div>

        <div class="w-1/2 flex-none">

            <form class="space-y-5" action="/admin/course-quick-add/{{$request->id}}" method="POST">
                @csrf

                <div>
                    <label for="course_name">Name</label>
                    <input id="course_name" type="text" name="course_name"
                           value="{{old('course_name', $request->name)}}">
                    @error('course_name')
                    <p>{{$message}}</p>
                    @enderror
                </div>

                <div>
                    <label for="grade">Grade</label>
                    <select name="grade" id="grade">
                        <option value="8"> 8 </option>
                        <option value="9"> 9 </option>
                        <option value="10"> 10 </option>
                        <option value="11"> 11 </option>
                        <option value="12"> 12 </option>
                    </select>
                        @error('grade')
                        <p>{{$message}}</p>
                        @enderror
                </div>

                <div>
                    <label for="description">description</label>
                    <textarea id="description" type="text" name="description"
                    >{{old('description', $request->description)}}</textarea>

                    @error('description')
                    <p>{{$message}}</p>
                    @enderror
                </div>


                <div>
                    <label for="subject">subject: </label>
                    <select name="subject" id="subject">
                        <option value="art">Visual Arts 2D/3D/Yearbook</option>
                        <option value="biology">Biology</option>
                        <option value="career">Career</option>
                        <option value="chemistry">Chemistry</option>
                        <option value="community">Community</option>
                        <option value="computers">Computers</option>
                        <option value="economics">Economics/Busyness/Finance</option>
                        <option value="engineering">Engineering</option>
                        <option value="english">English</option>
                        <option value="foods">Foods</option>
                        <option value="languages">Second Languages</option>
                        <option value="math">Math</option>
                        <option value="PE">PE/Active Living</option>
                        <option value="physics">Physics</option>
                        <option value="science">Science (Grade 10 and under)</option>
                        <option value="skills">Skills</option>
                        <option value="statistics">Statistics</option>
                        <option value="theatre">Theatre</option>
                    </select>
                    @error('subject')
                    <p>{{$message}}</p>
                    @enderror
                </div>



                <div>
                    <label for="code">Course Code </label>
                    <input type="text" id="code" name="code" value="{{old('code', $request->code)}}">
                </div>

                <div>
                    <label for="createteacher">teacher name </label>
                    <input type="checkbox" id="createteacher" name="createteacher" value="true">
                    <label for="createteacher"> Create new teacher</label><br>

                    <input id="teacher_name" type="text" name="teacher_name"
                           value="{{old('teacher_name', 'fake name')}}">

                    <input id="teacher_real_name" type="text" name="teacher_real_name"
                           value="{{old('teacher_real_name', $request->teacher_name)}}">

                    <div>
                        <label for="teacher">Teacher: </label>
                        <select name="teacher" id="teacher">
                            <option value="-1"> New</option>
                            @foreach($teachers as $teacher)

                                <option value="{{$teacher->id}}"> {{$teacher->real_name}} --> {{$teacher->name}}</option>
                            @endforeach
                        </select>
                        @error('teacher')
                        <p>{{$message}}</p>
                        @enderror
                    </div>

                    @error('createteacher')
                    <p>{{$message}}</p>
                    @enderror

                    @error('teacher_name')
                    <p>{{$message}}</p>
                    @enderror

                    @error('teacher_real_name')
                    <p>{{$message}}</p>
                    @enderror
                </div>

                <div>
                    <p>Add existing course template instead.</p>
                    <input type="checkbox" id="usetemplate" name="usetemplate" value="true">
                    <select name="template" id="template">
                        <option value="-1" selected>NONE</option>
                        @foreach($templates as $template)
                            <option value="{{$template->id}}">{{$template->course_name}}</option>
                        @endforeach
                    </select>

                    @error('usetemplate')
                    <p>{{$message}}</p>
                    @enderror

                    @error('template')
                    <p>{{$message}}</p>
                    @enderror
                </div>





                <button>Add Course</button>
            </form>

        </div>
    </div>


@endsection