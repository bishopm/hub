@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => 'https://westville.org.za'])
<p style="text-align: center;"><img src="{{ $message->embed(base_path('vendor/bishopm/hub/src/Resources/assets/images/logo.png')) }}" class="logo" alt="Hub logo"></p>
<p style="text-align: center;">Westville Community Hub</p>
@endcomponent
@endslot

{{-- Body --}}
# {{$subject}}

Dear {{$tenant}} @if ($contact<>$tenant) (Attention: {{$contact}}) @endif

{!!$body!!}

Thanks,<br>
{{ $sender }}<br>
Westville Community Hub

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
38 Jan Hofmeyr Road, Westville
@endcomponent
@endslot
@endcomponent