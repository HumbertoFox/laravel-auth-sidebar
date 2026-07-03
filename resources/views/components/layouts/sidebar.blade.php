<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Dashboard' }}</title>
    <script>
        (function() {
            const saved = localStorage.getItem('sidebar_collapsed');
            const isSmallScreen = window.innerWidth < 1024; // Mantido em 1024px

            // Se o usuário salvou como fechado OU se é a primeira vez em tela menor que 1024px
            const shouldCollapse = saved === 'true' || (saved === null && isSmallScreen);

            document.documentElement.setAttribute('data-sidebar-collapsed', shouldCollapse ? 'true' : 'false');
        })();
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fonts
</head>

<body class="flex min-h-screen relative">
    <div id="sidebar-backdrop" class="fixed inset-0 bg-black/40 z-40 hidden md:hidden"></div>

    <div class="min-w-full min-h-full flex gap-1 p-1.5">
        <x-sidebar.main />

        <main class="flex flex-1 flex-col px-1.5">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
