<details class="relative mt-auto group">
    <summary class="flex gap-2 items-center list-none cursor-pointer hover:bg-zinc-100 duration-500 p-2 rounded-lg max-lg:p-0 max-lg:justify-center hover:text-orange-400">
        <span class="flex items-center justify-center size-8 rounded-lg bg-zinc-200 text-xs font-medium">
            {{ strtoupper(substr($user['name'], 0, 1)) }}
        </span>
        <span class="font-semibold text-sm max-lg:hidden">{{ $user['name'] }}</span>
    </summary>

    <div class="absolute bottom-0 left-full w-56 rounded-md border border-gray-200 bg-white shadow-lg z-50 p-1">
        <x-dashboard.user-menu-content :user="$user" />
    </div>
</details>
