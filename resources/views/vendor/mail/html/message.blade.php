@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            @if(Storage::exists('logo.png') )
                <img src="{{url(Storage::url('logo.png')) }}" alt="SAM SERVE" style="width: 100px" />
            @else
                <img src="https://placehold.it/140x60/eee?text={{ get_platform_title() }}" alt="SAM SERVE" />
            @endif
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            &copy; {{ date('Y') }} {{ get_platform_title() }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
