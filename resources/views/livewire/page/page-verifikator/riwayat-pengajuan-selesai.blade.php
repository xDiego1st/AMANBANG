@php
    $dok_type_view = auth()->user()->type_validator;
@endphp
<livewire:data.table-upload-pemohon-verifikator :dok_status='3' :dok_type_view='$dok_type_view' />
