<form action="/admin/club/store" method="POST">
    @csrf
    <h1>Add New Club</h1>
    <label for="name">Club name</label>
    <input id="name" type="text" name="name"
           value="{{old('name')}}">
    @error('name')
    <p>{{$message}}</p>
    @enderror

    <label for="description">Club Description</label>
    <input id="description" type="text" name="description"
           value="{{old('description')}}">

    @error('description')
    <p>{{$message}}</p>
    @enderror

    <button>Add Club</button>
</form>
