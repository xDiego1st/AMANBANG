@props(['model', 'label'])

<div class="form-group">
    <label class="form-label">{{ $label }}</label>
    <div class="input-group-lg">
        <div wire:ignore>
            <textarea name="{{ $model }}" id="{{ $model }}" class="summernote-basic"></textarea>
        </div>
    </div>
    <div class="input-group"></div>
    @if ($errors->has($model))
    <span class="error">{{ $errors->first($model) }}</span>
    @endif
</div>


@push('scripts')
<script>
    $('#{{ $model }}').on('summernote.change', function(we, contents, $editable) {
        @this.set('{{ $model }}', contents)
    });
</script>
@endpush
