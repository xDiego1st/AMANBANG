@props(['model', 'label', 'labelDetail', 'labelOption', 'data', 'viewLabel' => false, 'opt' => false])

<div class="form-group">
    <div class="form-control-wrap">
        @if ($viewLabel)
            <label class="form-label" for="{{ $model }}" data-bs-toggle="tooltip" data-bs-placement="top"
                title="{{ $labelDetail }}">
                {{ $label }}
                @if (!$opt)
                    <span class="text-danger"><em class="icon ni ni-info-i"></em></span>
                @else
                    <span class="text-info"><em class="icon ni ni-info-i"></em></span>
                @endif
            </label>
        @endif
        <div class="input-group" wire:ignore>
            <select class="form-select js-select2" data-placeholder="Select {{ $label }}" data-search="on"
                id="{{ $model }}_sb" wire:model.live="{{ $model }}"
                onchange="return setSelectBox('{{ $model }}_sb','{{ $model }}');">
                <option value="">Select {{ $label }}</option>
                @foreach ($this->$data as $b)
                    <option value="{{ $b['id'] }}">{{ $b[$labelOption] }}</option>
                @endforeach
            </select>
        </div>
        @error($this->$model)
            <span class="error">{{ $message }}</span>
        @enderror
    </div>
</div>
