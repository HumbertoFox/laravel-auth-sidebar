<div class="min-w-1/2 min-h-screen hidden flex-col justify-between bg-zinc-900 text-white p-4 2xl:max-w-none 2xl:flex">
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
    <footer className="text-sm text-neutral-300">Your Laravel authentication system with Laravel Cloud.</footer>
</div>
