<x-layout>
    <section class="mx-auto w-full max-w-2xl py-6 pb-28 md:pb-40">
        <div class="rounded-3xl border border-white/15 bg-gradient-to-b from-white/[0.08] to-white/[0.03] p-8 shadow-2xl backdrop-blur-sm">
            <x-page-heading class="mb-2 text-3xl">Editar vaga</x-page-heading>
            <p class="mb-7 text-sm text-white/70">Atualiza os dados da tua vaga.</p>

            <x-forms.form method="PATCH" action="{{ route('jobs.update', $job) }}" class="max-w-none space-y-5">
                <x-forms.input label="Titulo da vaga" name="title" :value="$job->title" required />
                <x-forms.input label="Salario (ex: 110 000 USD/year)" name="salary" :value="$job->salary" required />
                <x-forms.input label="Localizacao" name="location" :value="$job->location" required />

                <x-forms.field label="Regime" name="schedule">
                    <select
                        id="schedule"
                        name="schedule"
                        class="w-full rounded-xl border border-white/15 bg-white/10 px-5 py-4 text-white outline-none transition focus:border-blue-400/70 focus:ring-2 focus:ring-blue-500/30"
                    >
                        <option value="full-time" @selected(old('schedule', $job->schedule) === 'full-time')>Full-time</option>
                        <option value="part-time" @selected(old('schedule', $job->schedule) === 'part-time')>Part-time</option>
                        <option value="contract" @selected(old('schedule', $job->schedule) === 'contract')>Contract</option>
                    </select>
                </x-forms.field>

                <x-forms.input label="URL da candidatura" name="url" type="url" :value="$job->url" />
                <x-forms.input
                    label="Tags (separadas por virgula)"
                    name="tags"
                    :value="old('tags', $job->tags->pluck('name')->implode(', '))"
                    placeholder="Laravel, Backend, React"
                />

                <x-forms.button class="w-full py-3">Guardar alteracoes</x-forms.button>
            </x-forms.form>
        </div>
    </section>
</x-layout>
