<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page not found</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <main class="w-full min-h-screen flex justify-center items-center bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="flex flex-col items-center gap-6 text-center">
            <h1 class="text-2xl font-semibold text-indigo-600">404</h1>
            <h2 class="mt-4 text-5xl font-semibold tracking-tight text-balance text-gray-900 sm:text-7xl">
                Page not found!
            </h2>
            <p class="mt-6 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8">
                Sorry, we couldn't find the page you're looking for.
            </p>
            <x-ui.button size="sm" type="button" onclick="history.back()">To go back</x-ui.button>
        </div>
    </main>
</body>

</html>
