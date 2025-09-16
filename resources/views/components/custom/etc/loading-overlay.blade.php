@props([
    'text' => 'Memproses...',
    'subtext' => 'Mohon tunggu sebentar',
    'target' => null, // contoh: "submit, upload.*"
    'position' => 'bottom-right', // bottom-right|bottom-left|top-right|top-left
])

@php
    $pos = match ($position) {
        'top-left' => 'top-0 start-0',
        'top-right' => 'top-0 end-0',
        'bottom-left' => 'bottom-0 start-0',
        default => 'bottom-0 end-0', // bottom-right
    };
@endphp

<div wire:loading.delay {{ $target ? "wire:target=$target" : '' }} class="position-fixed {{ $pos }} p-3"
    style="z-index:1085;" aria-live="polite" aria-atomic="true">

    <div class="border-0 shadow toast show text-bg-light">
        <div class="p-3 d-flex align-items-center">
            <div class="spinner-border spinner-border-sm me-3" role="status" aria-hidden="true"></div>
            <div class="me-2">
                <div class="fw-semibold">{{ $text }}</div>
                @if ($subtext)
                    <small class="opacity-75">{{ $subtext }}</small>
                @endif
            </div>
        </div>
    </div>
</div>
