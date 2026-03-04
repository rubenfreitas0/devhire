<x-layout>
    <section class="font-color">
        <div class="mb-6">
            <a href="{{ url()->previous() }}" class="text-sm text-white/70 underline hover:text-white">Voltar</a>
        </div>

        <x-job-card-wide>
            <div class="flex items-start gap-4">
                <div class="min-w-0">
                    <p class="text-sm text-white/75">{{ $job->employer?->name ?? 'Empresa sem nome' }}</p>
                    <h1 class="mt-1 text-3xl font-semibold text-white">{{ $job->title }}</h1>
                    <p class="mt-2 text-sm text-white/70">{{ $job->schedule }} - {{ $job->salary }}</p>
                </div>
            </div>

            <div class="mt-6 grid gap-3 text-sm text-white/75 md:grid-cols-3">
                <p><span class="text-white/55">Local:</span> {{ $job->location }}</p>
                <p><span class="text-white/55">Tipo:</span> {{ $job->schedule }}</p>
                <p>
                    <span class="text-white/55">Publicada:</span>
                    {{ $job->created_at?->format('d/m/Y') }}
                </p>
            </div>

            <div class="mt-5 flex flex-wrap gap-2">
                @forelse ($job->tags as $tag)
                    <x-tag :href="route('tags.results', $tag)">{{ $tag->name }}</x-tag>
                @empty
                    <x-tag>Sem tags</x-tag>
                @endforelse
            </div>

            @if (filled($job->url))
                <div class="mt-6">
                    <a class="inline-flex rounded-lg border border-white/20 px-4 py-2 text-sm text-white transition hover:bg-white/10" href="{{ $job->url }}" target="_blank" rel="noopener noreferrer">
                        Candidatar no site externo
                    </a>
                </div>
            @endif
        </x-job-card-wide>
    </section>
</x-layout>
