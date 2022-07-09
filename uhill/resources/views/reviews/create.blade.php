<form action="/course/{$course['id']}" method="POST">
    @csrf
    <h1>Add new review</h1>
<label for="title">Review Title</label>
<input id="title" type="text" name="title"
       value="{{old('title')}}">
    @error('title')
    <p>{{$message}}</p>
    @enderror

    <label for="rating">Rating</label>
    <input id="rating" type="number" name="rating"
    value="{{old('rating')}}">

    @error('rating')
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


