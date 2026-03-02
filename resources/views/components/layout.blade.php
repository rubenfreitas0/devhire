<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>DevHire - Plataforma de Recrutamento</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="background">
    @php
        $isAuthPage = request()->is('login') || request()->is('register');
    @endphp

    <div class="page-shell">
        <nav class="site-nav">
            <div>
                <a href="{{ route('home') }}">
                    <img class="site-logo" src="{{ asset('images/logo.svg') }}" alt="DevHire">
                </a>
            </div>
            <div class="site-nav-links">
                <a class="site-nav-link" href="">Vagas</a>
                <a class="site-nav-link" href="">Carreiras</a>
                <a class="site-nav-link" href="">Salarios</a>
                <a class="site-nav-link" href="">Empresas</a>
            </div>
            <div class="flex items-center gap-2">
                @auth
                    <a class="site-nav-link" href="{{ route('jobs.create') }}">Postar vaga</a>
                    <form method="POST" action="/logout">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="site-nav-cta">Logout</button>
                    </form>
                @else
                    <a class="site-nav-link" href="{{ route('jobs.create') }}">Postar vaga</a>
                    <a class="site-nav-link" href="/login">Login</a>
                    <a class="site-nav-cta" href="/register">Registar</a>
                @endauth
            </div>
        </nav>

        <main class="mx-auto {{ $isAuthPage ? 'mt-12' : 'mt-10' }} w-full max-w-[986px] px-6">
            {{ $slot }}
        </main>

        @unless ($isAuthPage)
            <x-footer />
        @endunless
    </div>
</body>
</html>
