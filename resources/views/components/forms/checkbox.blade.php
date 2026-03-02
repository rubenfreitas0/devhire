@props(['label', 'name'])

@php
    $defaults = [
        'type' => 'checkbox',
        'id' => $name,
        'name' => $name,
        'value' => 1,
        'class' => 'h-4 w-4 rounded border-white/30 bg-transparent text-blue-500 focus:ring-blue-500/40',
    ];
@endphp

<x-forms.field :$label :$name>
    <div class="w-full rounded-xl border border-white/15 bg-white/10 px-5 py-4 text-white">
        <label for="{{ $name }}" class="inline-flex items-center gap-2 text-sm text-white/90">
            <input {{ $attributes($defaults) }} @checked(old($name))>
            <span>{{ $label }}</span>
        </label>
    </div>
</x-forms.field>
