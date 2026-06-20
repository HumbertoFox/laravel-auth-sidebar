<div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm cursor-default">
    <x-dashboard.user-info :user="$user" :show-email="true" />
</div>

<x-ui.separator orientation="horizontal" class="self-stretch bg-gray-300" />

<a href="{{ route('settings') }}"
    class="flex items-center w-full px-2 py-1.5 text-sm rounded hover:bg-zinc-100 cursor-pointer">
    <x-lucide-settings class="size-4 mr-2" />
    Settings
</a>

<x-ui.separator orientation="horizontal" class="self-stretch bg-gray-300" />

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit"
        class="flex items-center w-full px-2 py-1.5 text-sm rounded hover:bg-zinc-100 cursor-pointer text-left">
        <x-lucide-log-out class="size-4 mr-2 rotate-180" />
        Exit
    </button>
</form>
