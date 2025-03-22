<x-hub::layouts.web pageName="{{$project->project}}">
    <div class="col-md-12 post-content" data-aos="fade-up">
        <h3>{{$project->project}}</h3>
        @foreach ($project->tags as $tag)
            <span class="badge bg-dark">{{$tag->name}}</span>
        @endforeach
        <br>
        {!! $project->description !!}
    </div>
</x-hub::layout>