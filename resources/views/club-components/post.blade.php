
<div class="mt-10">
  <p class="text-2xl font-ooga">{{$post->caption}}</p>
    @if(isset($post->club_post_pictures))
        @foreach($post->club_post_pictures as $picture)
            <div class="container overflow-hidden">
                <img class="w-full" src="/storage/clubPostImages/{{$picture->image}}">
            </div>
        @endforeach
    @endif
    <p class="text-gray-500 font-comfortaa">{{$post->created_at}}</p>
</div>

<div class="h-[1px] bg-blue-400"></div>