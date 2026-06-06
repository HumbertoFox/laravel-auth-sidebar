@props([
    'variant' => 'default',
    'size' => 'default',
    'type' => 'button',
])

@php
    $base =
        'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus:outline-none focus:ring-1 disabled:cursor-not-allowed disabled:opacity-50';

    $variants = [
        'default' =>
            'bg-zinc-900 text-white shadow hover:bg-zinc-700 focus:ring-zinc-500 dark:bg-zinc-50 dark:text-zinc-900 dark:hover:bg-zinc-200',
        'destructive' => 'bg-red-500 text-white shadow hover:bg-red-600 focus:ring-red-500',
        'outline' =>
            'border border-zinc-300 bg-transparent shadow-sm hover:bg-zinc-100 hover:text-zinc-900 focus:ring-zinc-500 dark:border-zinc-700 dark:hover:bg-zinc-800 dark:hover:text-zinc-100',
        'secondary' =>
            'bg-zinc-100 text-zinc-900 shadow-sm hover:bg-zinc-200 focus:ring-zinc-500 dark:bg-zinc-800 dark:text-zinc-100 dark:hover:bg-zinc-700',
        'ghost' =>
            'hover:bg-zinc-100 hover:text-zinc-900 focus:ring-zinc-500 dark:hover:bg-zinc-800 dark:hover:text-zinc-100',
        'link' => 'text-zinc-900 underline-offset-4 hover:underline dark:text-zinc-100',
    ];

    $sizes = [
        'default' => 'h-9 px-4 py-2',
        'sm' => 'h-8 px-3 text-xs',
        'lg' => 'h-10 px-8',
        'icon' => 'h-9 w-9',
    ];

    $classes = $base . ' ' . ($variants[$variant] ?? $variants['default']) . ' ' . ($sizes[$size] ?? $sizes['default']);
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
