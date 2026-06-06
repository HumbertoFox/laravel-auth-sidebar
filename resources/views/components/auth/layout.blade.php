@props(['title' => 'Auth'])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <main class="w-full min-h-screen flex">
        <div
            class="min-w-1/2 min-h-screen hidden flex-col justify-between bg-zinc-900 text-white p-4 2xl:max-w-none 2xl:flex">
            <div class="flex">
                <a href="/" class="flex items-center gap-2">
                    <x-app-logo-icon class="size-10" />
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            <div class="flex justify-center">
                <a href="/">
                    <x-app-logo-icon class="size-50" />
                </a>
            </div>
            <footer class="text-sm text-neutral-300">Your Laravel authentication system with Laravel Cloud.</footer>
        </div>

        {{ $slot }}
    </main>
</body>

</html>
