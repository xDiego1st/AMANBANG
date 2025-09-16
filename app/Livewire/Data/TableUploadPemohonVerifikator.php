<?php

namespace App\Livewire\Data;

use App\Exports\MultipleSheetExport;
use App\Models\DokumenPemohon;
use App\Models\StandarTargetHari;
use App\Models\VerifikatorHasPengajuan;
use App\Traits\WithCustomPagination;
use App\Traits\WithModelValue;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class TableUploadPemohonVerifikator extends Component
{
    use WithCustomPagination;
    use WithModelValue;

    #[Locked]
    public $ids;

    #[Locked]
    public $dok_status, $dok_type_view;
    public $type_view, $type_data;

    public function mount()
    {
        $this->uniqueId = Str::random(8);
    }

    public function render()
    {
        $query = $this->search();
        $data = $query->paginate($this->perPage, ['*'], 'page');
        return view('livewire.data.table-upload-pemohon-verifikator', [
            'data' => $data,
        ]);
    }
    private function search()
    {
        $verifikorId = auth()->id();
        $query = VerifikatorHasPengajuan::with([
            'user',
            'pengajuan.history',
            'pengajuan.user',
        ])->where('user_id', $verifikorId);

        if (isset($this->dok_status)) {
            if ($this->dok_status != 3) {
                $query->where('status_verifikator', $this->dok_status);
            } else {
                //jika 3 = complete
                $query->where('status_verifikator', '>=', $this->dok_status);
            }
        }

        // Hitung total semua data sebelum filter pencarian
        $this->totalAllData = (clone $query)->count();

        $this->totalData = (clone $query)->count();

        return $query;
    }
    public function exportData()
    {
        $fileName = 'Data_Stunting_' . now()->format('YmdHis') . '.xlsx';
        return (new MultipleSheetExport($this->search()))->download($fileName);
    }
    public function resetFilter()
    {
        $this->reset();
    }
    #[Computed]
    public function loadDokumen()
    {
        $dok = DokumenPemohon::all();
        return $dok;
    }
    #[Computed]
    public function sopTargetHariOperator()
    {
        return StandarTargetHari::find(2)?->sop_hari;
    }
    protected function slaDeadline($createdAt): ?Carbon
    {
        if (blank($createdAt)) {
            return null;
        }

        // Pastikan zona waktu Jakarta
        $start = Carbon::parse($createdAt)->timezone('Asia/Jakarta');

        // Tambah 1 hari kerja (weekday). addWeekdays melewati Sabtu/Minggu.
        // Catatan: ini mempertahankan jam-menit detik yang sama.
        return (clone $start)->addWeekdays($this->sopTargetHariOperator());
    }
    protected function fmtInterval(\DateInterval $diff): string
    {
        $parts = [];
        if ($diff->d) {
            $parts[] = $diff->d . ' hari';
        }

        if ($diff->h) {
            $parts[] = $diff->h . ' jam';
        }

        if ($diff->i) {
            $parts[] = $diff->i . ' menit';
        }

        if (empty($parts)) {
            $parts[] = 'kurang dari 1 menit';
        }

        return implode(' ', $parts);
    }
    public function slaInfo($createdAt): array
    {
        $deadline = $this->slaDeadline($createdAt);
        if (!$deadline) {
            return [
                'late' => false,
                'text' => '-',
                'badge' => 'badge bg-light text-muted',
                'icon' => 'ni-info',
                'deadline' => '-',
                'minutes_left' => 0,
                'notice' => 'Data tidak memiliki waktu mulai.',
            ];
        }

        $now = now('Asia/Jakarta');

        if ($now->greaterThan($deadline)) {
            $diff = $deadline->diff($now);
            return [
                'late' => true,
                'text' => 'Terlambat ' . $this->fmtInterval($diff),
                'badge' => 'badge bg-danger',
                'icon' => 'ni-alert-circle',
                'deadline' => $deadline->isoFormat('DD MMM YYYY HH:mm') . ' WIB',
                'minutes_left' => 0,
                'notice' => 'Segera verifikasi — melebihi batas SOP 1 hari kerja.',
            ];
        }

        // Masih dalam batas SOP
        $diff = $now->diff($deadline);
        $minutesLeft = $now->diffInMinutes($deadline);
        $badge = $minutesLeft <= 120 ? 'badge bg-warning text-dark' : 'badge bg-success';
        $icon = $minutesLeft <= 120 ? 'ni-clock' : 'ni-check-circle';

        return [
            'late' => false,
            'text' => 'Sisa ' . $this->fmtInterval($diff),
            'badge' => $badge,
            'icon' => $icon,
            'deadline' => $deadline->isoFormat('DD MMM YYYY HH:mm') . ' WIB',
            'minutes_left' => $minutesLeft,
            'notice' => $minutesLeft <= 120
            ? 'Hampir jatuh tempo — mohon segera diproses.'
            : 'Masih dalam batas SOP 1 hari kerja.',
        ];
    }
}
