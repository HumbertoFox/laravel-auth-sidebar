<details class="relative mt-auto group">
    <summary class="flex gap-2 items-center list-none cursor-pointer hover:bg-zinc-100 duration-500 p-2 rounded">
        <span class="flex items-center justify-center size-8 rounded-full bg-zinc-200 text-xs font-medium">
            {{ strtoupper(substr($user['name'], 0, 1)) }}
        </span>
        <span>{{ $user['name'] }}</span>
    </summary>

    <div class="absolute bottom-0 left-full w-56 rounded-md border border-gray-200 bg-white shadow-lg z-50 p-1">
        <x-dashboard.user-menu-content :user="$user" />
    </div>
</details>
