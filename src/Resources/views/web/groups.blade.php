<x-hub::layouts.web pageName="Groups">
    <div class="col-md-12 post-content" data-aos="fade-up">
        <table class="table table-condensed table-borderless table-striped">
            <tr><th colspan="2">Groups</th></tr>
            @forelse ($groups as $group)
                <tr>
                    <td><a href="{{url('/groups/' . $group->slug)}}">{{$group->tenant}}</a></td>
                    <td>
                        @foreach ($group->tags as $tag)
                            <span class="badge bg-dark">{{$tag->name}}</span>
                        @endforeach
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No groups have been added yet.</td>
                </tr>
            @endforelse
        </table>
    </div>
</x-hub::layout>