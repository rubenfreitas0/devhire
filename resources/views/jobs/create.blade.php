<x-layout>
    <section class="mx-auto w-full max-w-2xl py-6 pb-28 md:pb-40">
        <div class="rounded-3xl border border-white/15 bg-gradient-to-b from-white/[0.08] to-white/[0.03] p-8 shadow-2xl backdrop-blur-sm">
            <div class="mb-2 flex items-start justify-between gap-4">
                <x-page-heading class="text-3xl">Postar vaga</x-page-heading>
                <a
                    href="{{ url()->previous() }}"
                    class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-white/20 text-white/75 transition hover:border-white/45 hover:bg-white/10 hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-400/70"
                    aria-label="Voltar"
                    title="Voltar"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </a>
            </div>
            <p class="mb-7 text-sm text-white/70">Preenche os dados para publicar uma nova vaga.</p>

            <x-forms.form method="POST" action="{{ route('jobs.store') }}" class="max-w-none space-y-5">
                <x-forms.input label="Titulo da vaga" name="title" required />
                <x-forms.input label="Salario (ex: 110 000 USD/year)" name="salary" required />
                <x-forms.input label="Localizacao" name="location" required />

                <x-forms.field label="Regime" name="schedule">
                    <select
                        id="schedule"
                        name="schedule"
                        class="w-full rounded-xl border border-white/25 bg-white px-5 py-4 text-black outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30"
                    >
                        <option value="full-time" @selected(old('schedule', 'full-time') === 'full-time')>Full-time</option>
                        <option value="part-time" @selected(old('schedule') === 'part-time')>Part-time</option>
                        <option value="contract" @selected(old('schedule') === 'contract')>Contract</option>
                    </select>
                </x-forms.field>

                <x-forms.input label="URL da candidatura" name="url" type="url" required />
                <x-forms.input
                    label="Tags (separadas por virgula)"
                    name="tags"
                    placeholder="Laravel, Backend, React"
                />

                <x-forms.button class="w-full py-3">Publicar vaga</x-forms.button>
            </x-forms.form>
        </div>
    </section>
</x-layout>
