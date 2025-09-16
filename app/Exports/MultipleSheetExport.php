<?php

namespace App\Exports;

use App\Models\Stunting;
use DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultipleSheetExport implements WithMultipleSheets
{
    use Exportable;
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function sheets(): array
    {
        $sheets = [];

        // Kelompokkan data berdasarkan jml_hari_usia_ukur
        $dataGrouped = $this->data->orderBy('jml_hari_usia_ukur', 'asc')->get()->groupBy(function ($item) {
            // Hitung tahun dari jumlah hari usia saat ukur
            $years = (int) ($item->jml_hari_usia_ukur / 365);

            // Kembalikan kelompok berdasarkan tahun
            return $years . ' Tahun';
        });

        // Tambahkan setiap kelompok ke dalam array $sheets
        foreach ($dataGrouped as $title => $groupedData) {
            $sheets[] = new DataExportCollection($groupedData, $title);
        }

        return $sheets;
    }

}
