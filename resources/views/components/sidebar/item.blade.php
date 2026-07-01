@props(['route', 'label', 'icon'])

<a href="{{ route($route) }}" @class([
    'sidebar-item w-full flex items-center gap-1 rounded-lg transition-colors duration-300 overflow-hidden whitespace-nowrap',
    'bg-zinc-100 text-orange-400' => request()->routeIs($route),
    'hover:bg-zinc-100 hover:text-orange-400' => !request()->routeIs($route),
]) title="{{ $label }}">
    <x-dynamic-component :component="$icon" class="sidebar-icon shrink-0" />
    <span class="sidebar-label">{{ $label }}</span>
</a>
