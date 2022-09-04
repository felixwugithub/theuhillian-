@extends('layout')
@section('content')

    @auth
        @if(Auth::id() == $id)



            <div class="flex justify-center text-sm">
                <div class="w-full md:w-7/12 container relative bg-pinkie mx-auto p-10 md:p-24 my-10 font-comfortaa">

                    <div class="text-center text-spicyPink text-2xl font-comfortaa">{{$username}}</div>

                <form action="/profile/{{ $id }}/ " method="post" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PATCH')

                    <div class="flex justify-between items-center">
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" class="rounded-xl border-pink-50 border-2 focus:border-hotPink focus:ring-hotPink " value="{{old('name'),$name}}">
                    @error('name')
                    <p>{{$message}}</p>
                    @enderror
                    </div>

                    <div class="flex justify-between items-center">
                    <label for="grade">Grade</label>
                    <select name="grade" id="grade" class="rounded-xl border-pink-50 border-2 focus:border-hotPink focus:ring-hotPink ">
                        <option <?php if ($grade == 8) echo "selected";?> value="8">8</option>
                        <option <?php if ($grade == 9) echo "selected";?> value="9">9</option>
                        <option <?php if ($grade == 10) echo "selected";?> value="10">10</option>
                        <option <?php if ($grade == 11) echo "selected";?> value="11">11</option>
                        <option <?php if ($grade == 12) echo "selected";?> value="12">12</option>
                    </select>
                    @error('grade')
                    <p>{{$message}}</p>
                    @enderror
                    </div>


                    <div class="flex justify-between items-start">
                    <label for="description">Bio</label>
                    <textarea type="text" name="description"  id="description" class=" h-96 rounded-xl border-pink-50 border-2 focus:border-hotPink focus:ring-hotPink ">
                        {{old('description', $description)}}
                    </textarea>
                        @error('description')
                    <p>{{$message}}</p>
                    @enderror
                    </div>


                    <div class="flex justify-between items-center">
                    <label for="url">URL  </label>
                    <input type="url" name="url" value="{{old('url', $url)}}" id="url" pattern="https://.*" placeholder="https://example.com" class="rounded-xl border-pink-50 border-2 focus:border-hotPink focus:ring-hotPink ">
                    @error('url')
                    <p>{{$message}}</p>
                    @enderror
                    </div>


                    <div class="text-center justify-center mx-auto flex">
                    <button  type="submit" class="hover:text-hotPink hover:bg-spicyPink bg-felixSalmon m-5 p-3 rounded-lg border-1 border-hotPink">Submit Changes</button>
                    </div>

                </form>

                </div>
            </div>

            @endif
    @endauth



@endsection
