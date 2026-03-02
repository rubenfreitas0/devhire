<x-layout>
    <section class="mx-auto w-full max-w-md py-6 pb-16 md:pb-24">
        <div class="rounded-3xl border border-white/15 bg-gradient-to-b from-white/[0.08] to-white/[0.03] p-8 shadow-2xl backdrop-blur-sm">
            <p class="mb-3 text-center text-xs font-semibold uppercase tracking-[0.18em] text-blue-200/85">Welcome Back</p>
            <x-page-heading class="mb-2 text-3xl">Entrar</x-page-heading>
            <p class="mb-7 text-center text-sm text-white/70">Acede a tua conta para continuar.</p>

            <x-forms.form method="POST" action="/login" class="max-w-none space-y-5">
                <x-forms.input label="Email" name="email" type="email" required autocomplete="email" />
                <x-forms.input label="Password" name="password" type="password" required autocomplete="current-password" />

                <x-forms.button class="w-full py-3">Entrar</x-forms.button>
            </x-forms.form>

            <p class="mt-6 text-center text-sm text-white/70">
                Ainda nao tens conta?
                <a href="/register" class="font-semibold text-blue-300 hover:text-blue-200">Criar conta</a>
            </p>
        </div>
    </section>
</x-layout>

