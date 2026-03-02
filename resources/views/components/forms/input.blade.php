@props(['label', 'name'])

@php
    $type = $attributes->get('type', 'text');

    $defaults = [
        'type' => $type,
        'id' => $name,
        'name' => $name,
        'class' => 'w-full rounded-xl border border-white/15 bg-white/10 px-5 py-4 text-white placeholder-white/50 outline-none transition focus:border-blue-400/70 focus:ring-2 focus:ring-blue-500/30',
    ];

    if (!in_array($type, ['file', 'password'], true)) {
        $defaults['value'] = old($name);
    }
@endphp

<x-forms.field :$label :$name>
    <input {{ $attributes($defaults) }}>
</x-forms.field>
