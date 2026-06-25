<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>

    <script>
        (function () {
            const saved = localStorage.getItem('sidebar_collapsed');
            const isSmall = window.innerWidth < 1024;

            // Determina o estado inicial antes da página renderizar na tela
            const shouldCollapse = saved === 'true' || (saved === null && isSmall);

            // Injeta o atributo direto na tag HTML para que o CSS/Tailwind aplique o estilo instantaneamente
            document.documentElement.setAttribute('data-sidebar-collapsed', shouldCollapse ? 'true' : 'false');
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen">
    <div class="min-w-full min-h-full flex gap-1 p-1.5">
        <x-dashboard.sidebar />

        <main class="flex flex-1 flex-col px-1.5">
            {{ $slot }}
        </main>

    </div>
</body>

</html>
