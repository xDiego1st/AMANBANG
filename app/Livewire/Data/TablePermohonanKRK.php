<?php

namespace App\Livewire\Data;

use App\Models\DetailPemohon;
use App\Models\StandarTargetHari;
use App\Traits\WithCustomPagination;
use App\Traits\WithModelValue;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class TablePermohonanKRK extends Component
{
    use WithCustomPagination;
    use WithModelValue;

    #[Locked]
    public $ids; // For Selected

    //Filter
    public $f_status;
    public $f_jenis_pengajuan;
    public $type_view; // all , Only Have KRK no simbg, has have krk & no simbg
    public $table_view; // all , Only Have KRK no simbg, has have krk & no simbg
    protected $listeners = [
        'reloadTable' => '$refresh',
    ];
    public function mount()
    {
        $this->uniqueId = Str::random(8);
    }
    public function render()
    {
        $query = $this->search();
        $data = $query->paginate($this->perPage, ['*'], 'page');

        return view('livewire.data.table-permohonan-k-r-k', [
            'data' => $data,
        ]);
    }
    private function search()
    {
        $query = DetailPemohon::with('user', 'verifikatorAssignments', 'verifikatorAssignments.user');

        // Hitung total semua data sebelum filter pencarian
        $this->totalAllData = (clone $query)->count();

        // Terapkan filter pencarian berdasarkan textSearch
        $this->applyTextSearchFilter($query);

        // Terapkan filter berdasarkan property tertentu
        $this->applyVariableFilter($query);
        if ($this->type_view == '1') {
            $query->whereNull('nomor_registrasi_simbg')->where('status', '1');
        } else if ($this->type_view == '2') {
            $query->whereNotNull('nomor_registrasi_simbg')->whereNot('status', '0');
        } else if ($this->type_view == '0') {
            $query->whereNull('nomor_registrasi_simbg')->where('status', '0');
        } else if ($this->type_view == '3') {
            $query->where('status', '1');
        }
        $query->orderBy('created_at', $this->order); // urutkan berdasarkan created_at terbaru;
        $this->totalData = (clone $query)->count();

        return $query;
    }

    public function bulkButton()
    {
        //BulkButton
    }
    public function resetFilter()
    {
        //ClearFilter
    }
    public function exportData()
    {
        // $fileName = 'Data_Stunting_' . now()->format('YmdHis') . '.xlsx';
        // return (new MultipleSheetExport($this->search()))->download($fileName);
    }

    private function applyTextSearchFilter($query)
    {
        $term = trim($this->textSearch);
        $like = "%{$term}%";
        // Ambil semua kolom tabel secara dinamis lalu buang kolom yang tidak perlu
        $table = (new DetailPemohon)->getTable();
        $columns = collect(Schema::getColumnListing($table))
            ->reject(function ($c) {
                // kolom yang tidak relevan untuk pencarian bebas
                return in_array($c, [
                    'id',
                    'user_id',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                    // tambahkan kolom lain yang ingin di-skip di sini
                ]);
            })
            ->values()
            ->all();
        if (!empty($this->textSearch)) {
            $query->where(function ($q) use ($columns, $like) {
                foreach ($columns as $col) {
                    $q->orWhere($col, 'like', $like);
                }
            });
        }
    }
    private function applyVariableFilter($query)
    {
        foreach ([
            'status' => $this->f_status,
            'jenis_pengajuan' => $this->f_jenis_pengajuan,
            //add more..
        ] as $column => $value) {
            if (!empty($value)) {
                $query->where($column, $value);
            }
        }
    }
    public function setKeterangan($created_at)
    {

    }

    #[Computed]
    public function sopTargetHariOperator()
    {
        return StandarTargetHari::find(3)?->sop_hari;
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
