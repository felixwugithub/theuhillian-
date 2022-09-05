<div class="h-96 font-comfortaa">

    <div class="rounded-t-3xl bg-blue-100 text-center p-3">
        <h1 class="text-3xl text-slate-700 font-sf">{{$event->name}}</h1>
    </div>

    <div class="bg-blue-50 text-lg space-y-3 py-14 lg:px-36 px-8 rounded-b-3xl">
    <p class="text-xl">{{$event->description}}</p>
    <p>Start time: {{$event->start_time}}</p>
    <p>End time: {{$event->end_time}}</p>
    <p>Location: {{$event->location}}</p>
    <a class="text-hotPink href="{{$event->url}}">Event URL</a>
    </div>

</div>