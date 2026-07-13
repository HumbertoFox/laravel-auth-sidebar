@props([
    'label' => null,
    'error' => null,
    'id' => null,
    'type' => 'text',
    'placeholder' => '',
    'icon' => null,
    'iconPosition' => 'left',
])

@php
    $inputId = $id ?? 'input-' . uniqid();
    $hasError = !empty($error);
    $isPassword = $type === 'password';
    $hasIcon = !empty($icon) || $isPassword;
    $iconLeft = $hasIcon && $iconPosition === 'left' && !$isPassword;
    $iconRight = $hasIcon && ($iconPosition === 'right' || $isPassword);

    $baseClass =
        'flex h-9 w-full rounded-md border bg-transparent py-1 text-sm shadow-sm transition-colors placeholder:text-zinc-400 focus:outline-none focus:ring-1 disabled:cursor-not-allowed disabled:opacity-50 ' .
        ($iconLeft ? 'pl-9 pr-3 ' : '') .
        ($iconRight ? 'pl-3 pr-9 ' : '') .
        (!$hasIcon ? 'px-3 ' : '') .
        ($hasError
            ? 'border-red-500 focus:ring-red-500 text-red-900'
            : 'border-zinc-300 dark:border-zinc-700 focus:ring-zinc-500 dark:focus:ring-zinc-400 text-zinc-900 dark:text-zinc-100');
@endphp

<div class="flex flex-col gap-1.5">

    @if ($label)
        <label for="{{ $inputId }}"
            class="text-sm font-medium leading-none text-zinc-700 dark:text-zinc-300 peer-disabled:cursor-not-allowed peer-disabled:opacity-70 mr-auto">
            {{ $label }}
        </label>
    @endif

    <div class="relative">

        @if ($iconLeft)
            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-zinc-400">
                {!! $icon !!}
            </span>
        @endif

        <input id="{{ $inputId }}" type="{{ $type }}" placeholder="{{ $placeholder }}"
            {{ $attributes->merge(['class' => $baseClass]) }} />

        @if ($isPassword)
            <button type="button" data-password-toggle
                class="absolute inset-y-0 right-3 flex items-center text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300 transition-colors">
                <svg data-icon-eye xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    style="display: block;">
                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
                <svg data-icon-eye-off xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" style="display: none;">
                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94" />
                    <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19" />
                    <line x1="1" y1="1" x2="23" y2="23" />
                </svg>
            </button>
        @elseif ($iconRight)
            <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-zinc-400">
                {!! $icon !!}
            </span>
        @endif

    </div>

    @if ($hasError)
        <p class="text-xs text-red-500">{{ $error }}</p>
    @endif

</div>
