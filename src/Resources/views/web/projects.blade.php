<x-hub::layouts.web pageName="Groups">
    <div class="col-md-12 post-content" data-aos="fade-up">
        <table class="table table-condensed table-borderless table-striped">
            <tr><th colspan="2">Projects</th></tr>
            @forelse ($projects as $project)
                <tr>
                    <td><a href="{{url('/projects/' . $project->slug)}}">{{$project->project}}</a></td>
                    <td>
                        @if (isset($project->tags))
                            @foreach ($project->tags as $tag)
                                <span class="badge bg-dark">{{$tag->name}}</span>
                            @endforeach
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No projects have been added yet.</td>
                </tr>
            @endforelse
        </table>
    </div>
</x-hub::layout>