<x-hub::layouts.web pageName="{{$venue->venue}}">
    <div class="col-md-12 post-content" data-aos="fade-up">
        <h3>{{$venue->venue}}</h3>
        @foreach ($venue->tags as $tag)
            <span class="badge bg-dark"><a class="text-white" href="{{url('/subject/' . $tag->slug)}}">{{$tag->name}}</a></span>
        @endforeach
        <br>
        @if ($venue->image)
            <div class="row">
                <div class="col-md-6">
                    {!! $venue->description !!}
                </div>
                <div class="col-md-6">
                    <img style="max-width:100%;" src="{{setting('general.church_storage_url')}}/{{$venue->image}}" alt="Image" class="rounded">
                </div>
            </div>
        @else
            {!! $venue->description !!}
        @endif
    </div>
</x-hub::layout>