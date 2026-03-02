@php
    $intendedMethod = strtoupper((string) $attributes->get('method', 'GET'));
    $htmlMethod = $intendedMethod === 'GET' ? 'GET' : 'POST';
@endphp

<form method="{{ $htmlMethod }}" {{ $attributes->except('method')->class(["max-w-2xl mx-auto space-y-6"]) }}>
    @if ($intendedMethod !== 'GET')
        @csrf
        @if ($intendedMethod !== 'POST')
            @method($intendedMethod)
        @endif
    @endif

    {{ $slot }}
</form>
