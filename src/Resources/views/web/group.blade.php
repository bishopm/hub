<x-hub::layouts.web pageName="{{$group->tenant}}">
    <div class="col-md-12 post-content" data-aos="fade-up">
        <h3>{{$group->tenant}}</h3>
        @if ($group->publish==0)
            Sorry! This group does not have a public profile page
        @else
            @if ($group->image)
                <div class="row">
                    <div class="col-md-6 pb-2">
                        @foreach ($group->tags as $tag)
                            <span class="badge bg-dark"><a class="text-white" href="{{url('/subject/' . $tag->slug)}}">{{$tag->name}}</a></span>
                        @endforeach
                        <br>
                        {!! $group->description !!}
                        @if (isset($group->diaryentries[0]))
                            <h4>Next meeting</h4>
                            {{date('l, j F Y H:i', strtotime($group->diaryentries[0]->diarydatetime))}} 
                            <a href="{{url('/venues/' . $group->diaryentries[0]->venue->slug)}}">({{$group->diaryentries[0]->venue->venue}})</a>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <img style="max-width:100%;" src="{{setting('general.church_storage_url')}}/{{$group->image}}" alt="Image" class="rounded">
                    </div>
                </div>
            @else
                @foreach ($group->tags as $tag)
                    <span class="badge bg-dark"><a class="text-white" href="{{url('/subject/' . $tag->slug)}}">{{$tag->name}}</a></span>
                @endforeach
                <br>
                {!! $group->description !!}
                @if (isset($group->diaryentries[0]))
                    <h4>Next meeting</h4>
                    {{date('l, j F Y H:i', strtotime($group->diaryentries[0]->diarydatetime))}} 
                    <a href="{{url('/venues/' . $group->diaryentries[0]->venue->slug)}}">({{$group->diaryentries[0]->venue->venue}})</a>
                @endif
            @endif
        @endif
    </div>
</x-hub::layout>