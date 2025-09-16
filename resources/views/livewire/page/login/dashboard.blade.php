<div>
    {{-- DASHBOARD PENGAWAS --}}
    @if ($user->role == 'PENGAWAS')
        @livewire('page.page-operator.dashboard-operator')
    @endif

    {{-- DASHBOARD OPERATOR --}}
    @if ($user->role == 'ADMIN')
        @livewire('page.page-operator.dashboard-operator')
    @endif

    {{-- DASHBOARD VERIFIKATOR --}}
    @if ($user->role == 'VERIFIKATOR')
        @livewire('page-verifikator.dashboard-verifikator')
    @endif

    {{-- DASHBOARD PENGAWAS --}}
    @if ($user->role == 'SUPER-ADMIN')
        @livewire('page-verifikator.dashboard-verifikator')
    @endif

    @if ($user->role == 'PEMOHON')
        @livewire('page-applicant.page-list-table-bangunan-pemohon')
    @endif
</div>
