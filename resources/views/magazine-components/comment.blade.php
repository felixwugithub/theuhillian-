<div class="rounded-2xl p-10 m-5 font-slim bg-white/50" id="{{'c'.$comment->id}}">

    <div class="md:flex space-x-6 items-center justify-between">

        <div class="md:w-64 text-center md:text-left">
        <a class="md:w-64 font-comfortaa text-lg text-hotPink hover:text-spicyPink text-center md:text-left" href="/profile/{{$comment->user->id}}">{{$comment->user->username}}</a>
        </div>

        <p class="text-left w-full md:w-[65%]">
        {{$comment->content}}
        </p>

        <div id="likeBar" class="pt-3 md:w-64 mt-5 md:mt-1">
            <form action="{{route('like-article-comment', ['id' => $comment->id])}}">
                @method('POST')
                @csrf
                <div class="items-center flex w-48  text-sm font-comfortaa space-x-6">
                    @auth
                        @if($comment->isLikedBy(auth()->user()))
                            <button ><img class="w-5 h-5" src="/images/icons/liked.png" alt=""> </button>
                        @else
                            <button> <img class="w-5 h-5" src="/images/icons/like.png" alt=""></button>
                        @endif
                    @endauth

                    <p>Liked by {{$comment->likers()->count()}}</p>
                </div>

            </form>
        </div>

    </div>
</div>