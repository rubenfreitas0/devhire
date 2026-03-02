@props(['size' => 'text-4xl'])

<h1 {{ $attributes->merge(['class' => "mb-8 text-center font-bold text-white {$size}"]) }}>
    {{ $slot }}
</h1>
