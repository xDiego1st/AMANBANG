@props(['id', 'title' => '', 'size' => ''])
<div class="modal fade" id="{{ $id }}" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog {{ $size }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    wire:click="$set('editId', null)"></button>
            </div>
            {{ $slot }}
        </div>
    </div>
</div>
