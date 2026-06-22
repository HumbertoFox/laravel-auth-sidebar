<details class="relative mt-auto">
    <summary
        class="sidebar-item flex gap-2 items-center list-none cursor-pointer hover:bg-zinc-100 duration-500 rounded-lg hover:text-orange-400">
        <span class="flex items-center justify-center size-8 rounded-lg bg-zinc-200 text-xs font-medium">
            {{ strtoupper(substr($user['name'], 0, 1)) }}{{ strtoupper(substr(strrchr($user['name'], ' ') ?: $user['name'], 1, 1)) }}
        </span>
        <span class="sidebar-label font-semibold text-sm">{{ $user['name'] }}</span>
    </summary>

    <div class="absolute bottom-0 left-full w-56 rounded-md border border-gray-200 bg-white shadow-lg z-50 p-1">
        <x-dashboard.user-menu-content :user="$user" />
    </div>
</details>
