@props([
    'value' => '',
    'action' => route('jobs.search'),
])

<div class="mb-6">
    <form action="{{ $action }}" method="GET">
        <label for="job-search-input" class="mb-2 block text-sm font-semibold text-white">Pesquisar vagas</label>

        <div class="relative flex gap-2">
            <input
                id="job-search-input"
                name="q"
                type="search"
                value="{{ $value }}"
                placeholder="Ex.: Laravel, Backend, Remote..."
                class="w-full rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-sm text-white outline-none transition focus:border-blue-400/70 focus:bg-white/10"
            >

            <button
                type="submit"
                class="rounded-xl border border-white/20 px-4 py-3 text-sm font-semibold text-white transition hover:bg-white/10"
            >
                Pesquisar
            </button>

            @if ($value !== '')
                <a
                    href="{{ $action }}"
                    class="rounded-xl border border-white/20 px-4 py-3 text-sm font-semibold text-white/80 transition hover:bg-white/10"
                >
                    Limpar
                </a>
            @endif
        </div>
    </form>

    <p class="mt-2 text-xs text-white/60">Filtra por empresa, cargo, local e tags.</p>
</div>
