<x-hub::layouts.web pageName="Groups">
    <div class="col-md-9 post-content" data-aos="fade-up">
        <h1>Groups meeting here</h1>
        @forelse ($groups as $group)
            <p>{{$group->tenant}}</p>
        @empty
            No groups have been added yet.
        @endforelse
    </div>
</x-hub::layout>