<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen">
    <div class="min-w-full min-h-full flex gap-1 p-1.5">
        <!-- Sidebar -->
        <x-dashboard.sidebar />

        <!-- Conteúdo principal -->
        <main class="flex flex-1 flex-col px-1.5">
            {{ $slot }}
        </main>

    </div>
</body>

</html>
