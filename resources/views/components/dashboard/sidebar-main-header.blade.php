@props(['items' => []])

<header class="flex h-8 shrink-0 items-center gap-2 border-b border-b-gray-300 py-2">
    <button type="button" class="cursor-pointer" title="Sidebar" onclick="">
        <x-lucide-panel-left class="size-4" />
    </button>
    <x-ui.separator orientation="vertical" class="self-stretch bg-gray-300" />
    <nav class="flex items-center gap-1.5 text-sm">
        @foreach ($items as $index => $item)
            @if ($index === count($items) - 1 || empty($item['href']))
                <span class="text-muted-foreground cursor-default">
                    {{ $item['text'] }}
                </span>
            @else
                <a href="{{ $item['href'] }}" class="hover:underline">
                    {{ $item['text'] }}
                </a>
            @endif

            @if ($index !== count($items) - 1)
                <span class="text-muted-foreground">/</span>
            @endif
        @endforeach
    </nav>
</header>
