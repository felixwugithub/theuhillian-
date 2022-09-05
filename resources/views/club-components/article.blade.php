<div class="justify-aroundw-full lg:h-96 my-5">
    <a href="/magazine/article/{{str_replace(' ', '_', $article->title)}}">
        <div class="justify-around bg-blue-50 rounded-xl p-5 border-t-1 border-b-1 border-notRealBlack lg:w-full md:h-full flex-none md:flex mx-auto">

            <div class="content-between lg:w-7/12 pr-5 container relative pb-10 lg:pb-0">

                <div>
                    <h1 class="font-paper-thin text-2xl">{{substr($article->title, 0, 128)}}</h1>
                    <p class="font-didact text-lg">{{$article->author}}</p>
                </div>


                <div class="flex absolute bottom-0">
                    <p class="text-sm text-gray-500 font-comfortaa">
                        {{$article->published_at}}
                    </p>
                </div>

            </div>

            @if(isset($article->cover->image))
                <img class="lg:w-5/12 md:w-[33%] h-full object-cover" src="/storage/articleCovers/{{$article->cover->image}}" alt="">
            @endif

        </div>
    </a>
</div>