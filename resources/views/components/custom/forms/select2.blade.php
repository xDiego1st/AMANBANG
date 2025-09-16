@props(['model', 'label', 'labelDetail', 'labelOption', 'data'])
<div class="input-group" wire:ignore>
    <select class="form-select js-select2" data-placeholder="Select {{ $label }}" data-search="on"
        data-key="{{ $model }}" data-value="{{ old($model, data_get($this, $model)) }}"
        id="{{ $model }}_sb_{{ $this->uniqueId }}" wire:model.live="{{ $model }}"
        onchange="return setSelectBox('{{ $model }}_sb_{{ $this->uniqueId }}','{{ $model }}',true);">
        <option value="">Select {{ $label }}</option>

        @foreach (data_get($this, $data, []) as $b)
            <option value="{{ $b['value'] }}">{{ $b['label'] }}</option>
        @endforeach
    </select>
</div>
