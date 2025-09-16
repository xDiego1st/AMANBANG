@props(['model', 'label', 'data', 'labelOption', 'viewLabel'])

<div class="form-control-wrap">
    @if ($viewLabel == 'true')
        <label class="f" for="bidang_selectbox">{{ $label }}</label>
    @endif
    <div class="input-group" wire:ignore>
        <select class="form-select js-select2" data-placeholder="Select {{ $label }}" data-search="on"
            id="{{ $model }}_selectbox" wire:model.live="{{ $model }}"
            onchange="return setSelectBox('{{ $model }}_selectbox','{{ $model }}');">
            <option value="">Select {{ $label }}</option>
            @foreach ($this->$data as $b)
                <option value="{{ $b->id }}">{{ $b->$labelOption }}</option>
            @endforeach
        </select>
    </div>
    @error($this->$model)
        <span class="error">{{ $message }}</span>
    @enderror
</div>
