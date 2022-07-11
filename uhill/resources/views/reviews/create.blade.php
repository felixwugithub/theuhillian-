

<h2>You are reviewing {{$course['course_name']}}</h2>

<form action="/course/{{$course['id']}}" method="POST">
    @csrf
    <h1>Add new review</h1>
<label for="title">Review Title</label>
<input id="title" type="text" name="title"
       value="{{old('title')}}">
    @error('title')
    <p>{{$message}}</p>
    @enderror

    <label for="personality">Personality</label>
    <input id="personality" type="number" name="personality"
    value="{{old('personality')}}">

    @error('personality')
    <p>{{$message}}</p>
    @enderror

    <label for="fairness">Fairness</label>
    <input id="fairness" type="number" name="fairness"
           value="{{old('fairness')}}">

    @error('fairness')
    <p>{{$message}}</p>
    @enderror

    <label for="easiness">Easiness</label>
    <input id="easiness" type="number" name="easiness"
           value="{{old('easiness')}}">

    @error('easiness')
    <p>{{$message}}</p>
    @enderror

    <label for="content">Detailed review</label>
    <input id="content" type="text" name="content"
    value="{{old('content')}}">

    @error('content')
    <p>{{$message}}</p>
    @enderror

    <button>Add Review</button>

</form>


