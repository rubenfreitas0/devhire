@props([
    'href' => '#',
    'target' => '_self',
])

<a href="{{ $href }}" target="{{ $target }}" @if($target === '_blank') rel="noopener noreferrer" @endif class="inline-flex items-center rounded-full border border-white/10 bg-[#171717] px-3 py-1 text-xs font-semibold text-white/85 transition hover:bg-[#222] hover:text-white">
    {{ $slot }}
</a>
