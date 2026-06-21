@php
    $cards = [
        [
            'href' => route('user'),
            'color' => 'border-blue-500',
            'iconColor' => 'text-blue-500',
            'icon' => 'user-round',
        ],
        [
            'href' => route('profile'),
            'color' => 'border-green-500',
            'iconColor' => 'text-green-500',
            'icon' => 'file-sliders',
        ],
        [
            'href' => route('appearance'),
            'color' => 'border-purple-500',
            'iconColor' => 'text-purple-500',
            'icon' => 'monitor-cog',
        ],
    ];
@endphp

<x-dashboard.layout>
    <x-dashboard.sidebar-main-header :items="$breadcrumbItems" />

    <div class="flex flex-1 flex-col-reverse lg:flex-col gap-4 pt-2">
        <div class="bg-muted/50 flex-1 aspect-video rounded-xl border border-emerald-500"></div>

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            @foreach ($cards as $card)
                <a href="{{ $card['href'] }}"
                    class="flex items-center justify-center bg-muted/50 aspect-video rounded-xl border {{ $card['color'] }} hover:border-2 transition-all duration-200 hover:scale-[1.02] hover:shadow-lg hover:bg-gradient-to-br hover:from-muted hover:to-muted/60">
                    <x-dynamic-component :component="'lucide-' . $card['icon']" class="size-16 {{ $card['iconColor'] }}" />
                </a>
            @endforeach
        </div>
    </div>
</x-dashboard.layout>
