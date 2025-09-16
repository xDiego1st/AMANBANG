@props([
    'method' => 'submit', // nama method Livewire
    'label' => 'Submit', // teks normal
    'loadingText' => 'Memproses...', // teks saat loading
    'icon' => null, // contoh: 'ni ni-plus'
])

<button type="button" wire:click.prevent="{{ $method }}" wire:loading.attr="disabled"
    wire:target="{{ $method }}" {{ $attributes->merge(['class' => 'btn']) }}>
    {{-- Normal state --}}
    <em class="icon ni ni-plus" wire:loading.remove wire:target="{{ $method }}"></em>
    <span wire:loading.remove wire:target="{{ $method }}">{{ $label }}</span>

    <em class="spinner-border spinner-border-sm" wire:loading wire:target="{{ $method }}"></em>
    <span wire:loading wire:target="{{ $method }}">
    <span wire:loading wire:target="{{ $method }}">{{ $loadingText }}</span></span>
</button>
