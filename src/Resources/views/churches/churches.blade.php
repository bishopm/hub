<x-hub::layouts.churches pageName="Churches">
    <h3>Churches</h3>
    <ul class="list-unstyled">
        @forelse ($churches as $church)
            <li><a href="{{url('/churches/' . $church->slug)}}">{{$church->church}}</a></li>
        @empty
            No churches have been added yet
        @endforelse
    </ul>
</x-hub::layouts.churches>