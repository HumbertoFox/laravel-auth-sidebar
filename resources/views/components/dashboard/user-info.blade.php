@props(['user', 'showEmail' => false])

<div class="flex items-center gap-2">
    <span
        class="flex items-center justify-center size-8 rounded-lg bg-zinc-200 text-xs font-medium shrink-0 select-none">
        {{ strtoupper(substr($user['name'], 0, 1)) }}{{ strtoupper(substr(strrchr($user['name'], ' ') ?: $user['name'], 1, 1)) }}
    </span>

    <div class="flex flex-col leading-tight overflow-hidden">
        <span class="font-medium text-zinc-900 truncate">{{ $user['name'] }}</span>
        @if ($showEmail)
            <span class="text-xs text-zinc-500 truncate">{{ $user['email'] }}</span>
        @endif
    </div>
</div>
