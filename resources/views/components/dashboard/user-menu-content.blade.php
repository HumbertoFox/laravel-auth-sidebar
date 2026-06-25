<div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm cursor-default">
    <x-dashboard.user-info :user="$user" :show-email="true" />
</div>

<x-ui.separator orientation="horizontal" class="self-stretch bg-gray-200 my-1" />

<a href="{{ route('settings') }}"
    class="group/settings flex items-center w-full px-2 py-1.5 text-sm rounded hover:bg-zinc-100 cursor-pointer transition-colors duration-200">
    <x-lucide-settings class="size-4 mr-2 text-zinc-500 group-hover/settings:text-orange-400" />
    <span class="group-hover/settings:text-orange-400">Settings</span>
</a>

<x-ui.separator orientation="horizontal" class="self-stretch bg-gray-200 my-1" />

<form method="POST" action="{{ route('logout') }}" class="w-full">
    @csrf
    <button type="submit"
        class="flex items-center w-full px-2 py-1.5 text-sm rounded hover:bg-zinc-100 cursor-pointer text-left hover:text-red-600 transition-colors duration-200">
        <x-lucide-log-out class="size-4 mr-2 rotate-180" />
        Exit
    </button>
</form>
