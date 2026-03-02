<article
    tabindex="0"
    {{ $attributes->class(['job-card-interactive w-full min-h-[220px] rounded-2xl border border-white/15 bg-white/5 p-6 shadow-lg backdrop-blur-sm transition duration-200 hover:border-blue-300/50 hover:bg-white/[0.08] focus-visible:border-blue-300/70 focus-visible:outline-none']) }}
>
    {{ $slot }}
</article>
