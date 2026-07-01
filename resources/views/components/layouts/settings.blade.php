@php
    $sidebarNavItems = [
        ['text' => 'Settings', 'route' => 'settings'],
        ['text' => 'Profile', 'route' => 'profile'],
        ['text' => 'Verify Email', 'route' => 'verify-email'],
        ['text' => 'Password', 'route' => 'password'],
        ['text' => 'Appearance', 'route' => 'appearance'],
    ];

    $visibleItems = collect($sidebarNavItems)->filter(
        fn($item) => $item['route'] !== 'verify-email' || !$user['email_verified'],
    );
@endphp

<div class="mb-1 my-1 px-4 space-y-0.5">
    <h1 class="text-xl font-semibold tracking-tight">Settings</h1>
    <h2 class="text-muted-foreground text-sm">Manage your profile and account settings.</h2>
</div>

<x-separator class="my-6 md:hidden" />

<section class="max-w-xl flex flex-col gap-4 p-4 md:flex-row">
    <aside class="w-full max-w-xl lg:w-48 shrink-0">
        <nav class="flex flex-col gap-1">
            @foreach ($visibleItems as $item)
                <a href="{{ route($item['route']) }}" @class([
                    'w-full justify-start px-3 py-2 text-sm rounded-md transition-colors',
                    'bg-muted font-medium text-orange-400' => request()->routeIs($item['route']),
                    'hover:bg-muted/50 text-muted-foreground hover:text-foreground hover:text-orange-400' => !request()->routeIs(
                        $item['route']),
                ])>
                    {{ $item['text'] }}
                </a>
            @endforeach
        </nav>
    </aside>

    {{ $slot }}
</section>
