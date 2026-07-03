<x-layouts.sidebar title="Settings">
    <x-sidebar.main-header :items="$breadcrumbItems" />

    <x-layouts.settings>
        @php
            $initials = collect(explode(' ', trim($user['name'])))
                ->map(fn($part) => mb_substr($part, 0, 1))
                ->take(2)
                ->join('');

            $isEmailVerified = !empty($user['email_verified']);
        @endphp

        <div class="flex flex-1 flex-col lg:flex-row gap-4 cursor-default">
            <div class="size-40 rounded-lg overflow-hidden border border-gray-300">
                @if (!empty($user['avatar']))
                    <img src="{{ $user['avatar'] }}" alt="avatar {{ $user['name'] }}" class="size-full object-cover" />
                @else
                    <div
                        class="size-full flex items-center justify-center font-bold font-serif text-8xl bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white rounded-full">
                        {{ $initials }}
                    </div>
                @endif
            </div>

            <div class="flex flex-col justify-center gap-2 text-left leading-tight">
                <div class="group">
                    <strong>ID: </strong>
                    <span class="blur-sm group-hover:blur-none transition cursor-help">
                        {{ $user['id'] ?? '—' }}
                    </span>
                </div>

                <span class="font-extralight font-serif text-3xl">
                    <strong>{{ $user['name'] }}</strong>
                </span>

                <span class="text-muted-foreground truncate text-sm gap-x-1.5 inline-flex items-center">
                    {{ $user['email'] }}
                    @if ($isEmailVerified)
                        <x-lucide-badge-check class="text-green-500 size-6" />
                    @else
                        <x-lucide-badge-alert class="text-orange-500 size-6 italic" />
                    @endif
                </span>

                <div>
                    <strong>Account Type: </strong>
                    <span @class([
                        'font-serif',
                        'text-blue-800' => strtoupper($user['role']) === 'ADMIN',
                        'text-green-800' => strtoupper($user['role']) !== 'ADMIN',
                    ])>
                        {{ $user['role'] }}
                    </span>
                </div>
            </div>
        </div>

        <div class="flex gap-1">
            <strong>User created on: </strong>
            <span>
                @php
                    $createdAt = isset($user['created_at']) ? \Carbon\Carbon::parse($user['created_at']) : null;
                @endphp
                {{ $createdAt ? $createdAt->translatedFormat('M j, Y') : 'N/A' }}
            </span>
        </div>

        <div class="flex gap-1">
            <strong>User updated on: </strong>
            <span>
                @php
                    $updatedAt = isset($user['updated_at']) ? \Carbon\Carbon::parse($user['updated_at']) : null;
                @endphp
                {{ $updatedAt ? $updatedAt->translatedFormat('M j, Y') : 'N/A' }}
            </span>
        </div>
    </x-layouts.settings>
</x-layouts.sidebar>
