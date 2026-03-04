<x-layout>
    <section>
        <div class="mb-8">
            <x-page-heading>Results</x-page-heading>
            <p class="mt-2 text-sm text-white/70">
                Tag: <span class="font-semibold text-white">{{ $tag->name }}</span>
            </p>
        </div>

        <div class="space-y-6">
            @forelse ($jobs as $job)
                <x-job-card-wide>
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
                        @foreach ($job->tags as $jobTag)
                            <x-tag :href="route('tags.results', $jobTag)" target="_blank">{{ $jobTag->name }}</x-tag>
                        @endforeach
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
                <p class="text-sm text-white/70">Nao existem vagas para esta tag.</p>
            @endforelse
        </div>
    </section>
</x-layout>
