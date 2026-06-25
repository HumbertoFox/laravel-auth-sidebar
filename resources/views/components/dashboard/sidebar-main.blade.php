<div class="w-full flex flex-col gap-1 px-1.5 text-sm">
    <a href="{{ route('admins') }}"
        class="sidebar-item w-full flex items-center gap-1 hover:bg-zinc-100 rounded-lg transition-colors duration-300 hover:text-orange-400 overflow-hidden whitespace-nowrap"
        title="Admins">
        <x-lucide-user-cog class="sidebar-icon shrink-0" />
        <span class="sidebar-label">Admins</span>
    </a>

    <a href="{{ route('users') }}"
        class="sidebar-item w-full flex items-center gap-1 hover:bg-zinc-100 rounded-lg transition-colors duration-300 hover:text-orange-400 overflow-hidden whitespace-nowrap"
        title="Users">
        <x-lucide-users-2 class="sidebar-icon shrink-0" />
        <span class="sidebar-label">Users</span>
    </a>
</div>
