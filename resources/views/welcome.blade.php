<x-layout>
    <section class="font-color">
        <x-section-heading />
        <x-search-bar />

        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            <x-job-card data-job-card>
                <div class="mb-4 flex items-center justify-between">
                    <p class="text-sm text-white/75">Microsoft</p>
                    <img src="https://placehold.co/42x42" alt="Logo da empresa" class="h-10 w-10 rounded-full border border-white/20">
                </div>

                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-white">Full-Stack Developer</h3>
                    <p class="mt-2 text-sm text-white/70">Full Time - $60 000 USD</p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <x-tag>Laravel</x-tag>
                    <x-tag>Vue</x-tag>
                    <x-tag>Remote</x-tag>
                </div>
            </x-job-card>

            <x-job-card data-job-card>
                <div class="mb-4 flex items-center justify-between">
                    <p class="text-sm text-white/75">Spotify</p>
                    <img src="https://placehold.co/42x42" alt="Logo da empresa" class="h-10 w-10 rounded-full border border-white/20">
                </div>

                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-white">Frontend Engineer</h3>
                    <p class="mt-2 text-sm text-white/70">Hibrido - $55 000 USD</p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <x-tag>React</x-tag>
                    <x-tag>TypeScript</x-tag>
                    <x-tag>UI</x-tag>
                </div>
            </x-job-card>

            <x-job-card data-job-card>
                <div class="mb-4 flex items-center justify-between">
                    <p class="text-sm text-white/75">Stripe</p>
                    <img src="https://placehold.co/42x42" alt="Logo da empresa" class="h-10 w-10 rounded-full border border-white/20">
                </div>

                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-white">Backend Developer</h3>
                    <p class="mt-2 text-sm text-white/70">Remote - $70 000 USD</p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <x-tag>PHP</x-tag>
                    <x-tag>Laravel</x-tag>
                    <x-tag>API</x-tag>
                </div>
            </x-job-card>
        </div>

        <div class="mt-8">
            <p class="mb-3 text-sm font-semibold text-white">
                <span class="mr-2 inline-block h-2 w-2 bg-white"></span>Tags
            </p>
            <div class="flex flex-wrap gap-2 md:flex-nowrap">
                <x-tag>Frontend</x-tag>
                <x-tag>Backend</x-tag>
                <x-tag>API</x-tag>
                <x-tag>Laravel</x-tag>
                <x-tag>React</x-tag>
                <x-tag>TypeScript</x-tag>
                <x-tag>PHP</x-tag>
                <x-tag>Remote</x-tag>
                <x-tag>Full Time</x-tag>
                <x-tag>Hibrido</x-tag>
            </div>
            <div class="mt-2 flex flex-wrap gap-2 md:flex-nowrap">
                <x-tag>Senior</x-tag>
                <x-tag>Junior</x-tag>
                <x-tag>DevOps</x-tag>
                <x-tag>Mobile</x-tag>
                <x-tag>Cloud</x-tag>
                <x-tag>Node</x-tag>
                <x-tag>Python</x-tag>
                <x-tag>UI/UX</x-tag>
                <x-tag>On-site</x-tag>
                <x-tag>Data</x-tag>
            </div>
        </div>

        <div class="mt-8 space-y-8">
            <x-job-card-wide data-job-card>
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                        <p class="text-sm text-white/75">Microsoft</p>
                        <h3 class="mt-1 text-2xl font-semibold text-white">Senior Full-Stack Developer</h3>
                        <p class="mt-2 text-sm text-white/70">Full Time - $60 000 USD</p>
                    </div>
                    <img src="https://placehold.co/56x56" alt="Logo da empresa" class="h-14 w-14 rounded-full border border-white/20 object-cover">
                </div>
                <div class="mt-4 grid gap-2 text-sm text-white/75 md:grid-cols-3">
                    <p><span class="text-white/55">Local:</span> Remote</p>
                    <p><span class="text-white/55">Nivel:</span> Senior</p>
                    <p><span class="text-white/55">Experiencia:</span> 5+ anos</p>
                </div>
                <div class="mt-4 flex flex-wrap gap-2">
                    <x-tag>Laravel</x-tag>
                    <x-tag>Vue</x-tag>
                    <x-tag>MySQL</x-tag>
                    <x-tag>Docker</x-tag>
                    <x-tag>AWS</x-tag>
                    <x-tag>CI/CD</x-tag>
                </div>
            </x-job-card-wide>

            <x-job-card-wide data-job-card>
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                        <p class="text-sm text-white/75">Stripe</p>
                        <h3 class="mt-1 text-2xl font-semibold text-white">Backend Developer - Payments API</h3>
                        <p class="mt-2 text-sm text-white/70">Remote - $70 000 USD</p>
                    </div>
                    <img src="https://placehold.co/56x56" alt="Logo da empresa" class="h-14 w-14 rounded-full border border-white/20 object-cover">
                </div>
                <div class="mt-4 grid gap-2 text-sm text-white/75 md:grid-cols-3">
                    <p><span class="text-white/55">Local:</span> Porto</p>
                    <p><span class="text-white/55">Nivel:</span> Senior</p>
                    <p><span class="text-white/55">Experiencia:</span> 4+ anos</p>
                </div>
                <div class="mt-4 flex flex-wrap gap-2">
                    <x-tag>PHP</x-tag>
                    <x-tag>Laravel</x-tag>
                    <x-tag>API</x-tag>
                    <x-tag>Redis</x-tag>
                    <x-tag>PostgreSQL</x-tag>
                    <x-tag>Microservices</x-tag>
                </div>
            </x-job-card-wide>
        </div>

        <p id="job-search-empty" class="mt-5 text-sm text-white/60" style="display:none;">
            Sem resultados para a tua pesquisa.
        </p>
    </section>
</x-layout>
