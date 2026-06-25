<a href="{{ url('/dashboard') }}"
    class="sidebar-item w-full flex items-center gap-1 p-1.5 hover:bg-zinc-100 rounded-lg transition-colors duration-300 hover:text-orange-400 overflow-hidden whitespace-nowrap"
    title="Dashboard">

    <x-app-logo-icon class="size-8 shrink-0" />

    <span class="sidebar-label text-sm font-semibold">{{ config('app.name', 'Laravel') }}</span>
</a>
