@php
    $sidebarNavItems = [
        ['text' => 'Settings', 'route' => 'dashboard.settings.index'],
        ['text' => 'Profile', 'route' => 'dashboard.settings.profile'],
        ['text' => 'Verify Email', 'route' => 'dashboard.settings.verifyemail'],
        ['text' => 'Password', 'route' => 'dashboard.settings.password'],
        ['text' => 'Appearance', 'route' => 'dashboard.settings.appearance'],
    ];

    $visibleItems = collect($sidebarNavItems)->filter(
        fn($item) => $item['route'] !== 'verifyemail' || !$user['email_verified'],
    );
@endphp

<div class="mb-1 my-1 px-4 space-y-0.5">
    <h1 class="text-xl font-semibold tracking-tight">Settings</h1>
    <h2 class="text-muted-foreground text-sm">Manage your profile and account settings.</h2>
</div>

<section class="flex flex-col gap-2 p-4 md:flex-row">
    <aside class="min-w-48 max-w-xl lg:w-48 shrink-0">
        <nav class="flex flex-col gap-1">
            @foreach ($visibleItems as $item)
                <a href="{{ route($item['route']) }}" @class([
                    'flex justify-start px-3 py-1 text-sm transition-colors mr-auto',
                    'italic bg-muted font-medium text-orange-400' => request()->routeIs(
                        $item['route']),
                    'hover:bg-muted/50 text-muted-foreground hover:text-foreground hover:text-orange-400' => !request()->routeIs(
                        $item['route']),
                ])>
                    {{ $item['text'] }}
                </a>
            @endforeach
        </nav>
    </aside>

    <x-separator orientation="horizontal" class="md:hidden" />

    <div class="w-full flex flex-col gap-2">
        {{ $slot }}
    </div>
</section>
