<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>DevHire - Plataforma de Recrutamento</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="background">
    <div>
        <nav class="site-nav">
            <div>
                <a href="{{ route('home') }}">
                    <img class="site-logo" src="{{ asset('images/logo.svg') }}" alt="DevHire">
                </a>
            </div>
            <div class="site-nav-links">
                <a class="site-nav-link" href="">Vagas</a>
                <a class="site-nav-link" href="">Carreiras</a>
                <a class="site-nav-link" href="">Salários</a>
                <a class="site-nav-link" href="">Empresas</a>
            </div>
            <div>
                <a class="site-nav-cta" href="">Postar Vaga</a>
            </div>
        </nav>
        <main class="mx-auto mt-10 w-full max-w-[986px] px-6">
            {{ $slot }}
        </main>
        <x-footer />
    </div>
</body>
</html>
