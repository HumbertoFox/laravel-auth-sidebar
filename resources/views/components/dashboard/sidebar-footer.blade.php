<details class="relative mt-auto group/menu">
    <summary
        class="sidebar-item w-full flex gap-2 items-center list-none cursor-pointer hover:bg-zinc-100 transition-colors duration-300 rounded-lg hover:text-orange-400 overflow-hidden whitespace-nowrap"
        title="{{ $user['name'] }}">

        <span class="flex items-center justify-center size-8 rounded-lg bg-zinc-200 text-xs font-medium shrink-0">
            {{ strtoupper(substr($user['name'], 0, 1)) }}{{ strtoupper(substr(strrchr($user['name'], ' ') ?: $user['name'], 1, 1)) }}
        </span>

        <span class="sidebar-label font-semibold text-sm">{{ $user['name'] }}</span>
    </summary>

    <div
        class="absolute bottom-0 left-full mb-1 ml-2 w-56 rounded-md border border-gray-200 bg-white shadow-lg z-50 p-1">
        <x-dashboard.user-menu-content :user="$user" />
    </div>
</details>
