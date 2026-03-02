<x-layout>
    <section class="font-color">
        <x-section-heading />
        <x-search-bar />

        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($featuredJobs as $job)
                <x-job-card data-job-card>
                    <div class="mb-4 flex items-center justify-between gap-3">
                        <p class="text-sm text-white/75">{{ $job->employer?->name ?? 'Empresa sem nome' }}</p>
                        <img
                            src="{{ $job->employer ? $job->employer->logoUrl(42) : 'https://api.dicebear.com/9.x/initials/svg?seed=Employer&size=42&radius=50' }}"
                            alt="Logo da empresa"
                            class="h-10 w-10 rounded-full border border-white/20 object-cover"
                        >
                    </div>

                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-white">{{ $job->title }}</h3>
                        <p class="mt-2 text-sm text-white/70">{{ $job->schedule }} - {{ $job->salary }}</p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        @forelse ($job->tags as $tag)
                            <x-tag :href="route('tags.results', $tag)" target="_blank">{{ $tag->name }}</x-tag>
                        @empty
                            <x-tag>Sem tags</x-tag>
                        @endforelse
                    </div>

                    @auth
                        @if (auth()->id() === $job->employer?->user_id)
                            <form method="POST" action="{{ route('jobs.destroy', $job) }}" class="mt-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-lg border border-red-400/40 px-3 py-1 text-xs text-red-200 transition hover:bg-red-500/20">
                                    Eliminar vaga
                                </button>
                            </form>
                        @endif
                    @endauth
                </x-job-card>
            @empty
                <p class="text-sm text-white/70">Nenhuma vaga encontrada no momento.</p>
            @endforelse
        </div>

        <div class="mt-8">
            <p class="mb-3 text-sm font-semibold text-white">
                <span class="mr-2 inline-block h-2 w-2 bg-white"></span>Tags
            </p>

            <div class="flex flex-wrap gap-2 md:flex-nowrap">
                @forelse ($tags as $tag)
                    <x-tag :href="route('tags.results', $tag)" target="_blank">{{ $tag->name }}</x-tag>
                @empty
                    <p class="text-sm text-white/70">Nenhuma tag encontrada.</p>
                @endforelse
            </div>
        </div>

        <div class="mt-8 space-y-8">
            @forelse ($wideJobs as $job)
                <x-job-card-wide data-job-card>
                    <div class="flex items-start justify-between gap-4">
                        <div class="min-w-0">
                            <p class="text-sm text-white/75">{{ $job->employer?->name ?? 'Empresa sem nome' }}</p>
                            <h3 class="mt-1 text-2xl font-semibold text-white">{{ $job->title }}</h3>
                            <p class="mt-2 text-sm text-white/70">{{ $job->schedule }} - {{ $job->salary }}</p>
                        </div>
                        <img
                            src="{{ $job->employer ? $job->employer->logoUrl(56) : 'https://api.dicebear.com/9.x/initials/svg?seed=Employer&size=56&radius=50' }}"
                            alt="Logo da empresa"
                            class="h-14 w-14 rounded-full border border-white/20 object-cover"
                        >
                    </div>
                    <div class="mt-4 grid gap-2 text-sm text-white/75 md:grid-cols-3">
                        <p><span class="text-white/55">Local:</span> {{ $job->location }}</p>
                        <p><span class="text-white/55">Tipo:</span> {{ $job->schedule }}</p>
                        <p>
                            <span class="text-white/55">Candidatura:</span>
                            <a class="underline hover:text-white" href="{{ $job->url }}" target="_blank" rel="noopener noreferrer">Abrir vaga</a>
                        </p>
                    </div>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @forelse ($job->tags as $tag)
                            <x-tag :href="route('tags.results', $tag)" target="_blank">{{ $tag->name }}</x-tag>
                        @empty
                            <x-tag>Sem tags</x-tag>
                        @endforelse
                    </div>

                    @auth
                        @if (auth()->id() === $job->employer?->user_id)
                            <form method="POST" action="{{ route('jobs.destroy', $job) }}" class="mt-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-lg border border-red-400/40 px-3 py-1 text-xs text-red-200 transition hover:bg-red-500/20">
                                    Eliminar vaga
                                </button>
                            </form>
                        @endif
                    @endauth
                </x-job-card-wide>
            @empty
                <p class="text-sm text-white/70">Nenhuma vaga encontrada para esta pagina.</p>
            @endforelse
        </div>

        <div class="mt-8 flex items-center justify-between">
            <div>
                @if ($wideJobs->previousPageUrl())
                    <a href="{{ $wideJobs->previousPageUrl() }}" class="rounded-lg border border-white/20 px-4 py-2 text-sm text-white transition hover:bg-white/10">
                        Anterior
                    </a>
                @endif
            </div>

            <span class="text-sm text-white/70">Pagina {{ $wideJobs->currentPage() }}</span>

            <div>
                @if ($wideJobs->nextPageUrl())
                    <a href="{{ $wideJobs->nextPageUrl() }}" class="rounded-lg border border-white/20 px-4 py-2 text-sm text-white transition hover:bg-white/10">
                        Proxima
                    </a>
                @endif
            </div>
        </div>
    </section>
</x-layout>

