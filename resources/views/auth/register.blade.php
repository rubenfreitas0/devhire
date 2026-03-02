<x-layout>
    <section class="mx-auto w-full max-w-xl py-6 pb-28 md:pb-40">
        <div class="rounded-3xl border border-white/15 bg-gradient-to-b from-white/[0.08] to-white/[0.03] p-8 shadow-2xl backdrop-blur-sm">
            <p class="mb-3 text-center text-xs font-semibold uppercase tracking-[0.18em] text-emerald-200/85">New Account</p>
            <x-page-heading class="mb-2 text-3xl">Registar</x-page-heading>
            <p class="mb-7 text-center text-sm text-white/70">Cria a tua conta e comeca a publicar vagas.</p>

            <x-forms.form method="POST" action="/register" enctype="multipart/form-data" class="max-w-none space-y-5">
                <x-forms.input label="Nome" name="name" required autocomplete="name" />
                <x-forms.input label="Email" name="email" type="email" required autocomplete="email" />
                <x-forms.input label="Password" name="password" type="password" required autocomplete="new-password" />
                <x-forms.input label="Confirmar Password" name="password_confirmation" type="password" required autocomplete="new-password" />

                <x-forms.divider />

                <x-forms.input label="Nome da Empresa" name="employer" required />
                <x-forms.input
                    label="Tags da vaga (separadas por virgula)"
                    name="job_tags"
                    placeholder="Laravel, Backend, React"
                />

                <x-forms.field label="Logotipo da Empresa" name="logo">
                    <input
                        id="logo"
                        name="logo"
                        type="file"
                        accept="image/*"
                        class="w-full rounded-xl border border-white/15 bg-white/10 px-4 py-3 text-white file:mr-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:font-semibold file:text-white file:transition hover:file:bg-blue-500"
                    >
                    <p class="mt-2 text-xs text-white/60">PNG, JPG ou WEBP ate 5MB.</p>
                </x-forms.field>

                <x-forms.button class="w-full py-3">Criar conta</x-forms.button>
            </x-forms.form>

            <p class="mt-6 text-center text-sm text-white/70">
                Ja tens conta?
                <a href="/login" class="font-semibold text-blue-300 hover:text-blue-200">Entrar</a>
            </p>
        </div>
    </section>
</x-layout>
