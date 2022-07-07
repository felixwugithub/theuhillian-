<h1>
    Register.
</h1>

<form method="POST" action="/users">
    @csrf

    <label for="name">Name</label>
    <input type="text" name="name" value="{{old('name')}}">
    @error('name')
    <p>{{$message}}</p>
    @enderror

    <lable>Email</lable>
    <input type="email" name="email" value="{{old('email')}}">
    @error('email')
    <p>{{$message}}</p>
    @enderror

    <lable>Password</lable>
    <input type="password" name="password">
    @error('password')
    <p>{{$message}}</p>
    @enderror

    <lable>Password Confirmation</lable>
    <input type="password" name="password_confirmation">
    @error('password_confirmation')
    <p>{{$message}}</p>
    @enderror

    <button type="submit">Register</button>

</form>
