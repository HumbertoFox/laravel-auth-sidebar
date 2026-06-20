@props(['user', 'showEmail' => false])

<div class="flex items-center gap-2">
    <span class="flex items-center justify-center size-8 rounded-full bg-zinc-200 text-xs font-medium shrink-0">
        {{ strtoupper(substr($user['name'], 0, 1)) }}{{ strtoupper(substr(strrchr($user['name'], ' ') ?: $user['name'], 1, 1)) }}
    </span>

    <div class="flex flex-col leading-tight">
        <span class="font-medium">{{ $user['name'] }}</span>
        @if ($showEmail)
            <span class="text-xs text-muted-foreground">{{ $user['email'] }}</span>
        @endif
    </div>
</div>
