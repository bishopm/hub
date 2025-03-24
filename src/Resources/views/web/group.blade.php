<x-hub::layouts.web pageName="{{$group->tenant}}">
    <div class="col-md-12 post-content" data-aos="fade-up">
        <h3>{{$group->tenant}}</h3>
        @foreach ($group->tags as $tag)
            <span class="badge bg-dark"><a class="text-white" href="{{url('/subject/' . $tag->slug)}}">{{$tag->name}}</a></span>
        @endforeach
        <br>
        {!! $group->description !!}
    </div>
</x-hub::layout>