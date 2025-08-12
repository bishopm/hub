<x-hub::layouts.web pageName="{{$project->project}}">
    <div class="col-md-12 post-content" data-aos="fade-up">
        <h3>{{$project->project}}</h3>
        @if ($project->image)
            <div class="row">
                <div class="col-md-6 pb-2">
                    @foreach ($project->tags as $tag)
                        <span class="badge bg-dark"><a class="text-white" href="{{url('/subject/' . $tag->slug)}}">{{$tag->name}}</a></span>
                    @endforeach
                    <br>
                    {!! $project->description !!}
                    @if (isset($project->diaryentries[0]))
                        <h4>Next meeting</h4>
                        {{date('l, j F Y H:i', strtotime($project->diaryentries[0]->diarydatetime))}} 
                        <a href="{{url('/venues/' . $project->diaryentries[0]->venue->slug)}}">({{$project->diaryentries[0]->venue->venue}})</a>
                    @endif
                </div>
                <div class="col-md-6">
                    <img style="max-width:100%;" src="{{setting('general.church_storage_url')}}/{{$project->image}}" alt="Image" class="rounded">
                </div>
        @else
            @foreach ($project->tags as $tag)
                <span class="badge bg-dark"><a class="text-white" href="{{url('/subject/' . $tag->slug)}}">{{$tag->name}}</a></span>
            @endforeach
            <br>
            {!! $project->description !!}
            @if (isset($project->diaryentries[0]))
                <h4>Next meeting</h4>
                {{date('l, j F Y H:i', strtotime($project->diaryentries[0]->diarydatetime))}} 
                <a href="{{url('/venues/' . $project->diaryentries[0]->venue->slug)}}">({{$project->diaryentries[0]->venue->venue}})</a>
            @endif
        @endif
    </div>
</x-hub::layout>