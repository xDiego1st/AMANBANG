@foreach ($section_data['fields'] as $field_name => $validation)
    @if (isset($field_details[$field_name]) && $this->shouldDisplayField($field_name))
        @php
            $field = (object) $field_details[$field_name];
        @endphp
        <div class="{{ $field->class }}">
            <div class="form-group">
                <label class="form-label" for="{{ $field_name }}" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="{{ $field->label . ' | ' . $field->desc }}">
                    {{ $field->label }}
                    @if ($this->isFieldRequired($field_name))
                        <span class="text-danger">
                            <em class="icon ni ni-info-i"></em>
                        </span>
                    @else
                        <span class="badge bg-warning">Optional</span>
                    @endif

                </label>
                <div class="form-control-wrap">
                    @if ($field->type == 'text')
                        <input wire:model.blur="formdata.{{ $field_name }}" type="text" class="form-control"
                            id="{{ $field_name }}" placeholder="{{ $field->label }}">
                    @elseif ($field->type == 'email')
                        <input wire:model.blur="formdata.{{ $field_name }}" type="email" class="form-control"
                            id="{{ $field_name }}" placeholder="{{ $field->label }}">
                    @elseif ($field->type == 'number')
                        <input onkeypress="return isNumberKey(event)" wire:model.blur="formdata.{{ $field_name }}"
                            type="text" class="form-control" placeholder="{{ $field->label }}"
                            maxlength="{{ $field->maxlength ?? '' }}}">

                        @if (isset($field->maxlength) && $field->maxlength < 20)
                            <div class="form-text-hint">
                                <span class="overline-title">
                                    {{ strlen($formdata[$field_name]) < $field->maxlength ? '-' . ($field->maxlength - strlen($formdata[$field_name])) : strtoupper(substr($field_name, 0, 3)) }}
                                </span>
                            </div>
                        @endif
                    @elseif ($field->type == 'textarea')
                        <textarea wire:model.blur="formdata.{{ $field_name }}" class="form-control" id="{{ $field_name }}"
                            placeholder="{{ $field->label }}" rows="3"></textarea>
                    @elseif ($field->type == 'select')
                        <x-custom.forms.select2 data="field_details.{{ $field_name }}.data_select"
                            model="formdata.{{ $field_name }}" label="{{ $field->label }}"
                            labelDetail="Pilih {{ $field->label }}" />
                    @elseif ($field->type == 'radio')
                        <div class="form-control-wrap">
                            @foreach ($field->data_select as $option)
                                <div class="form-check">
                                    <input wire:model.blur="formdata.{{ $field_name }}" type="radio"
                                        class="form-check-input" id="{{ $field_name }}_{{ $loop->index }}"
                                        value="{{ $option['value'] }}">
                                    <label class="form-check-label" for="{{ $field_name }}_{{ $loop->index }}">
                                        {{ $option['label'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @elseif ($field->type == 'checkbox')
                        <div class="form-control-wrap">
                            @foreach ($field->data_select as $option)
                                <div class="form-check">
                                    <input wire:model.blur="formdata.{{ $field_name }}" type="checkbox"
                                        class="form-check-input" id="{{ $field_name }}_{{ $loop->index }}"
                                        value="{{ $option['value'] }}">
                                    <label class="form-check-label" for="{{ $field_name }}_{{ $loop->index }}">
                                        {{ $option['label'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @elseif ($field->type == 'checkbox_single')
                        <div class="form-control-wrap">
                            @foreach ($field->data_select as $option)
                                <div class="form-check">
                                    <input wire:model.blur="formdata.{{ $field_name }}" type="checkbox"
                                        class="form-check-input" id="{{ $field_name }}"
                                        value="{{ $option['value'] }}">
                                    <label class="form-check-label" for="{{ $field_name }}">
                                        {{ $option['label'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @elseif ($field->type == 'file')
                        <x-custom.forms.file-uploads model="formdata.{{ $field_name }}" label="{{ $field->label }}"
                            wire:key='{{ time() }}' />
                    @elseif ($field->type == 'date')
                        <input wire:model.blur="formdata.{{ $field_name }}" type="date" class="form-control"
                            id="{{ $field_name }}">
                    @elseif ($field->type == 'time')
                        <input wire:model.blur="formdata.{{ $field_name }}" type="time" class="form-control"
                            id="{{ $field_name }}">
                    @elseif ($field->type == 'datetime-local')
                        <input wire:model.blur="formdata.{{ $field_name }}" type="datetime-local"
                            class="form-control" id="{{ $field_name }}">
                    @endif
                    {{-- Error Messages --}}
                    @if ($errors->has('formdata.' . $field_name))
                        <span class="error text-danger">
                            {{ $errors->first('formdata.' . $field_name) }}
                        </span>
                    @else
                        @if (empty(data_get($formdata, $field_name)))
                            @if ($field->type == 'file')
                                <small>
                                    <span class="error text-warning-emphasis">{{ $field->desc }}</span>
                                </small>
                            @else
                                <span class="error text-primary">{{ $field->desc }}</span>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endif
@endforeach
