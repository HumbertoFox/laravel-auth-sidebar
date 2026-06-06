<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <x-dashboard.sidebar />

    <!-- Conteúdo principal -->
    <div class="flex-1 flex flex-col">
        <x-dashboard.sidebar-header />

        <main class="flex-1 p-6">
            {{ $slot }}
        </main>

        <x-dashboard.nav-user />
    </div>
</body>

</html>
