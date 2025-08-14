<x-hub::layouts.web pageName="{{$resident->resident}}">
    <div class="col-md-12" data-aos="fade-up">
        <h1>{{$resident->resident}}</h1>
        <div style="min-height: 270px;">
            @if ($resident->image)
                <div class="row">
                    <div class="col-md-6 pb-2">
                        @if ($resident->website)
                            <p>Website: <a href="{{$resident->website}}" target="_blank">{{$resident->website}}</a></p>
                        @endif
                        @if ($resident->contact)
                            <p>Contact: {{$resident->contact}}</p>
                        @endif
                        {!! $resident->description !!}
                    </div>
                    <div class="col-md-6">
                        <img style="max-width:100%;" src="{{asset('storage/public/' . $resident->image)}}" alt="Image" class="rounded">
                    </div>
                </div>
            @else
                @if ($resident->website)
                    <p>Website: <a href="{{$resident->website}}" target="_blank">{{$resident->website}}</a></p>
                @endif
                @if ($resident->contact)
                    <p>Contact: {{$resident->contact}}</p>
                @endif
                {!!$resident->description!!}
            @endif
        </div>
    </div>
</x-hub::layout>