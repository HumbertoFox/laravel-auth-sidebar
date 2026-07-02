@props(['items' => []])

<header class="flex h-8 shrink-0 items-center gap-2 border-b border-b-gray-200 py-2">
    <button type="button" id="sidebar-toggle"
        class="cursor-pointer transition-colors duration-300 hover:text-orange-400 p-1 rounded hover:bg-zinc-100 flex items-center justify-center"
        title="Sidebar">
        <x-lucide-panel-left class="size-4" />
    </button>

    <x-separator orientation="vertical" class="self-stretch my-2" />

    <nav class="flex items-center gap-1.5 text-sm">
        @foreach ($items as $index => $item)
            @if ($index === count($items) - 1 || empty($item['href']))
                <span class="text-zinc-500 cursor-default font-medium">
                    {{ $item['text'] }}
                </span>
            @else
                <a href="{{ $item['href'] }}"
                    class="text-zinc-700 hover:text-orange-400 font-medium transition-colors duration-200">
                    {{ $item['text'] }}
                </a>
            @endif

            @if ($index !== count($items) - 1)
                <span class="text-zinc-400 select-none">/</span>
            @endif
        @endforeach
    </nav>
</header>
