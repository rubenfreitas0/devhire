<x-layout>
    <section class="mx-auto w-full max-w-2xl py-6 pb-28 md:pb-40">
        <div class="rounded-3xl border border-white/15 bg-gradient-to-b from-white/[0.08] to-white/[0.03] p-8 shadow-2xl backdrop-blur-sm">
            <x-page-heading class="mb-2 text-3xl">Editar empresa</x-page-heading>
            <p class="mb-7 text-sm text-white/70">Atualiza o nome e o logotipo da tua empresa.</p>

            <x-forms.form method="PATCH" action="{{ route('employer.update', $employer) }}" enctype="multipart/form-data" class="max-w-none space-y-5">
                <x-forms.input label="Nome da empresa" name="name" :value="old('name', $employer->name)" required />

                <x-forms.field label="Logotipo da empresa" name="logo">
                    <input
                        id="logo"
                        name="logo"
                        type="file"
                        accept="image/*"
                        class="w-full rounded-xl border border-white/15 bg-white/10 px-4 py-3 text-white file:mr-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:font-semibold file:text-white file:transition hover:file:bg-blue-500"
                    >
                    <p class="mt-2 text-xs text-white/60">Opcional. PNG, JPG ou WEBP ate 5MB.</p>
                </x-forms.field>

                <x-forms.button class="w-full py-3">Guardar empresa</x-forms.button>
            </x-forms.form>
        </div>
    </section>
</x-layout>
