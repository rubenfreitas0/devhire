<x-layout>
    <section class="font-color">
        <div class="mb-8">
            <p class="mb-2 inline-block rounded-full border border-blue-400/40 bg-blue-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-blue-200">
                Pesquisa
            </p>
            <h2 class="text-3xl font-bold text-white">Resultados</h2>
            <p class="mt-2 text-sm text-white/70">Mostrando vagas em formato detalhado.</p>
        </div>

        <x-search-bar :value="$q" />

        <div class="mt-8 space-y-8">
            @forelse ($wideJobs as $job)
                <x-job-card-wide data-job-card>
                    <div class="flex items-start gap-4">
                        <div class="min-w-0">
                            <p class="text-sm text-white/75">{{ $job->employer?->name ?? 'Empresa sem nome' }}</p>
                            <h3 class="mt-1 text-2xl font-semibold text-white">{{ $job->title }}</h3>
                            <p class="mt-2 text-sm text-white/70">{{ $job->schedule }} - {{ $job->salary }}</p>
                        </div>
                    </div>
                    <div class="mt-4 grid gap-2 text-sm text-white/75 md:grid-cols-3">
                        <p><span class="text-white/55">Local:</span> {{ $job->location }}</p>
                        <p><span class="text-white/55">Tipo:</span> {{ $job->schedule }}</p>
                        <p>
                            <span class="text-white/55">Candidatura:</span>
                            <a class="underline hover:text-white" href="{{ route('jobs.show', $job) }}">Abrir vaga</a>
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
                            <div class="mt-4 flex items-center gap-2">
                                <a href="{{ route('jobs.edit', $job) }}" class="rounded-lg border border-blue-400/40 px-3 py-1 text-xs text-blue-200 transition hover:bg-blue-500/20">
                                    Editar vaga
                                </a>
                                <form method="POST" action="{{ route('jobs.destroy', $job) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-lg border border-red-400/40 px-3 py-1 text-xs text-red-200 transition hover:bg-red-500/20">
                                        Eliminar vaga
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </x-job-card-wide>
            @empty
                <p class="text-sm text-white/70">
                    {{ $q !== '' ? 'Sem resultados para "'.$q.'".' : 'Sem resultados para os filtros selecionados.' }}
                </p>
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

