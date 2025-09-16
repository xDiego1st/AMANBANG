@props(['model', 'label','opt'])

<div class="form-group" x-data="{ do_{{ $model }}: false, progress: 0 }" x-on:livewire-upload-start="do_{{ $model }} = true" x-on:livewire-upload-finish="do_{{ $model }} = true" x-on:livewire-upload-error="do_{{ $model }} = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
    <label class="form-label" for="upload_surat_pernyataan" data-bs-toggle="tooltip" data-bs-placement="top" title="Max: 1MB | Only PDF,PNG,JPG">
        {{ $label }}
        @if ($opt=="true")
        <span class="badge bg-warning"> Optional </span>
        @else
        <span><em class="icon ni ni-info-i text-danger"></em></span>
        @endif
    </label>
    <div class="input-group">
        <input wire:model="{{ $model }}" type="file" accept=".pdf, .jpg, .jpeg, .png" class="form-control" placeholder="Upload {{ $label }}">
    </div>
    <!-- Progress Bar -->
    <div x-show="do_{{ $model }}">
        <progress max="100" x-bind:value="progress" class="btn-block"></progress>
    </div>
    @if ($errors->has($model))
    <span class="error">{{ $errors->first($model) }}</span>
    @else
    @if (!$this->$model)
    <span class="error text-info">Maksimal File 1MB : PDF | PNG | JPG</span>
    @endif
    @endif

    @if ($this->ids)
    <hr>
        @if ($this->$model)
            @if ($this->$model->getClientOriginalExtension() !== 'pdf')
                <img src="{{ $this->$model->temporaryUrl() }}">
            @else
                <span class="badge bg-primary btn-block text-wrap">Sorry, this extension is not supported for preview, but the file has been successfully uploaded.</span>
            @endif
        @else
            <embed src="{{ route('media.show', ['id' => $this->ids, 'collectionName' => $model]) }}" type="application/pdf" width="100%" height="100%">
        @endif
    @endif


</div>
