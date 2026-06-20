@props([
    'orientation' => 'horizontal',
])

<div data-slot="separator"
    {{ $attributes->class([
        'bg-border shrink-0',
        'h-px w-full' => $orientation === 'horizontal',
        'h-full w-px' => $orientation === 'vertical',
    ]) }}>
</div>
