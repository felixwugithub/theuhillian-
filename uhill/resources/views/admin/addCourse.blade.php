@auth
    @if(auth()->user()->admin == 1)
       ADD COURSE?

       <form action="/admin/course/store" method="POST">
           @csrf
           <h1>Add new course template</h1>
           <label for="course_name">Name</label>
           <input id="course_name" type="text" name="course_name"
                  value="{{old('course_name')}}">
           @error('course_name')
           <p>{{$message}}</p>
           @enderror

           <label for="grade">Grade</label>
           <select name="grade" id="grade">
               <option value="8"> 8 </option>
               <option value="9"> 9 </option>
               <option value="10"> 10 </option>
               <option value="11"> 11 </option>
               <option value="12"> 12 </option>
               <option value="13"> All Grades </option>
           </select>

           @error('grade')
           <p>{{$message}}</p>
           @enderror

           <label for="description">description</label>
           <input id="description" type="text" name="description"
                  value="{{old('description')}}">

           @error('description')
           <p>{{$message}}</p>
           @enderror


           <button>Add Course</button>
       </form>

    @else
        <p>You are not admin</p>
    @endif

@endauth


