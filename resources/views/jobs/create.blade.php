<x-layout>
    <section class="mx-auto w-full max-w-2xl py-6 pb-28 md:pb-40">
        <div class="rounded-3xl border border-white/15 bg-gradient-to-b from-white/[0.08] to-white/[0.03] p-8 shadow-2xl backdrop-blur-sm">
            <x-page-heading class="mb-2 text-3xl">Postar vaga</x-page-heading>
            <p class="mb-7 text-sm text-white/70">Preenche os dados para publicar uma nova vaga.</p>

            <x-forms.form method="POST" action="{{ route('jobs.store') }}" class="max-w-none space-y-5">
                <x-forms.input label="Titulo da vaga" name="title" required />
                <x-forms.input label="Salario (ex: 110 000 USD/year)" name="salary" required />
                <x-forms.input label="Localizacao" name="location" required />

                <x-forms.field label="Regime" name="schedule">
                    <select
                        id="schedule"
                        name="schedule"
                        class="w-full rounded-xl border border-white/15 bg-white/10 px-5 py-4 text-white outline-none transition focus:border-blue-400/70 focus:ring-2 focus:ring-blue-500/30"
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
