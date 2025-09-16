@props(['model', 'label'])

@php
    $value = data_get($this, $model);
    $id = str_replace(['.', '[', ']'], '_', $model); // Buat ID aman dari titik
@endphp

<div class="form-group" x-data="{ do_{{ $id }}: false, progress: 0 }" x-on:livewire-upload-start="do_{{ $id }} = true"
    x-on:livewire-upload-finish="do_{{ $id }} = true"
    x-on:livewire-upload-error="do_{{ $id }} = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress">

    {{-- Input --}}
    <div class="input-group">
        <input wire:model="{{ $model }}" type="file" accept=".pdf, .jpg, .jpeg, .png" class="form-control"
            id="upload_{{ $id }}" placeholder="Upload {{ $label }}">
    </div>

    {{-- Progress Bar --}}
    <div x-show="do_{{ $id }}">
        <progress max="100" x-bind:value="progress" class="mt-2 btn-block w-100"></progress>
    </div>
</div>
