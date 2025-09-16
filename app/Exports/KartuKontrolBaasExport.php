<?php

namespace App\Exports;

use App\Models\Intervensi;
use App\Models\Stunting;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KartuKontrolBaasExport implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting, ShouldAutoSize, WithMapping, WithTitle, WithEvents
{
    protected $data;
    protected $rowNumber; // Add this line
    private $sheet_name;
    protected $imagePath;
    public function __construct()
    {
// Query menggunakan Eloquent untuk mendapatkan entri terbaru untuk setiap 'nik'
        $this->data = Intervensi::select('intervensis.*')
            ->where('intervensis.jenis_intervensi', 'BAAS')
            ->whereIn('intervensis.id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('intervensis')
                    ->where('jenis_intervensi', 'BAAS')
                    ->groupBy('nik');
            })
            ->get();
        $this->sheet_name = "Kartu Kontrol BAAS 2024";
    }
    public function collection()
    {
        return $this->data;
    }
    // public function startCell(): string
    // {
    //     return 'A3';
    // }

    public function headings(): array
    {
        return [
            ['NO', 'NAMA BAAS', 'INSTANSI', 'SEBELUM PENYERAHAN BAAS', '', 'Jumlah Penyerahan BAAS (Berapa Kali)', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'NIK', 'NAMA BALITA', 'JK', 'TGL LAHIR', 'USIA', 'NAMA ORTU', 'KECAMATAN', 'PUSKESMAS', 'KELURAHAN', 'POSYANDU', 'RT', 'RW', 'ALAMAT', 'TB/U'],
            ['', '', '', '', '', '1', '', '', '2', '', '', '3', '', '', '4', '', '', '5', '', '', '6', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''],
            ['', '', '', 'BB', 'TB', 'BB', 'TB', 'Tangal Penyerahan', 'BB', 'TB', 'Tangal Penyerahan', 'BB', 'TB', 'Tangal Penyerahan', 'BB', 'TB', 'Tangal Penyerahan', 'BB', 'TB', 'Tangal Penyerahan', 'BB', 'TB', 'Tangal Penyerahan', '', '', '', '', '', '', '', '', '', '', '', '', '', ''],
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => '@', // No
            'B' => '@', // Nama Lengkap
            'C' => '@', // NIK
            'D' => '@', // JK
            'E' => '@', // Tgl Lahir
            'F' => '@', // BB Lahir
            'G' => '@', // TB Lahir
            'H' => '@', // Nama Ortu
            'I' => '@', // Provinsi
            'J' => '@', // Kab/Kota
            'K' => '@', // Kecamatan
            'L' => '@', // Puskesmas
            'M' => '@', // Desa/Kel
            'N' => '@', // Posyandu
            'O' => '@', // RT
            'P' => '@', // RW
            'Q' => '@', // Alamat
            'R' => '@', // Usia Saat Ukur
            'S' => '@', // Tgl Pengukuran
            'T' => '@', // Berat Badan
            'U' => '@', // Tinggi Badan
            'V' => '@', // Lila
            'W' => '@', // BB/U
            'X' => '0', // Z-Score BB/U
            'Y' => '@', // BB/TB
            'Z' => '@', // Z-Score BB/TB
            'AA' => '@', // Naik Berat Badan
            'AB' => '@', // PMT Diterima
            'AC' => '@', // Jml Vit A
            'AD' => '@', // KPSP
            'AE' => '@', // KIA
            'AF' => '@', // Latitude
            'AG' => '@', // Longitude
        ];
    }

    // Method for Customize  data
    public function map($row): array
    {
        if (!isset($this->rowNumber)) {
            $this->rowNumber = 0;
        }

        ++$this->rowNumber;
        $data = Stunting::where('nik', $row->nik)->first();

        return [
            $this->rowNumber,
            $row->BAAS,
            $row->asal_intansi,
            $data?->bb_lahir,
            $data?->tb_lahir,
            //1
            '1',
            '1',
            '1',
            //2
            '1',
            '1',
            '1',
            //3
            '1',
            '1',
            '1',
            //4
            '1',
            '1',
            '1',
            //5
            '1',
            '1',
            '1',
            //6
            '1',
            '1',
            '1',
            $data?->nik,
            $data?->nama,
            $data?->jk,
            $data?->tgl_lahir,
            '1',
            $data?->nama_ortu,
            $data?->kecamatan,
            $data?->puskesmas,
            $row->Kelurahan,
            $data?->posyandu,
            $data?->rt,
            $data?->rw,
            $data?->alamat,
            $data?->tb_u,
        ];
    }
    public function styles(Worksheet $sheet)
    {

        // Apply thin border to all text cells
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $range = 'A1:' . $highestColumn . $highestRow;

        // Apply general styling
        $sheet->getStyle('A1:AK3')->applyFromArray([
            'font' => [
                'bold' => true,
                // 'color' => array('rgb' => 'FF0000'),
                'size' => 11,
                'name' => 'Bahnschrift SemiBold Condensed',
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);

        // font except header
        // Apply general styling
        $sheet->getStyle('A4:AK' . $highestRow)->applyFromArray([
            'font' => [
                'bold' => false,
                // 'color' => array('rgb' => 'FF0000'),
                'size' => 7,
                'name' => 'Arial',
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'quotePrefix' => true,
        ]);

        // Merge cells for headers
        $sheet->mergeCells('A1:A3');
        $sheet->mergeCells('B1:B3');
        $sheet->mergeCells('C1:C3');
        $sheet->mergeCells('D1:E2');
        $sheet->mergeCells('F1:W1');
        $sheet->mergeCells('F2:H2');
        $sheet->mergeCells('I2:K2');
        $sheet->mergeCells('L2:N2');
        $sheet->mergeCells('O2:Q2');
        $sheet->mergeCells('R2:T2');
        $sheet->mergeCells('U2:W2');
        $sheet->mergeCells('X1:X3');
        $sheet->mergeCells('Y1:Y3');
        $sheet->mergeCells('Z1:Z3');
        $sheet->mergeCells('AA1:AA3');
        $sheet->mergeCells('AB1:AB3');
        $sheet->mergeCells('AC1:AC3');
        $sheet->mergeCells('AD1:AD3');
        $sheet->mergeCells('AE1:AE3');
        $sheet->mergeCells('AF1:AF3');
        $sheet->mergeCells('AG1:AG3');
        $sheet->mergeCells('AH1:AH3');
        $sheet->mergeCells('AI1:AI3');
        $sheet->mergeCells('AJ1:AJ3');
        $sheet->mergeCells('AK1:AK3');
        $sheet->getStyle($range)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);
    }
    public function registerEvents(): array
    {

        return [
            AfterSheet::class => function (AfterSheet $event) {
                $highestRow = $event->sheet->getHighestRow();
                $highestColumn = $event->sheet->getHighestColumn();

                // Atur tinggi baris secara keseluruhan
                for ($row = 4; $row <= $this->data->count() + 1; $row++) { // +1 karena baris header
                    $event->sheet->getRowDimension($row)->setRowHeight(24);
                    // Terapkan gaya ke setiap sel dalam baris
                    $event->sheet->getStyle('A' . $row . ':AG' . $row)->applyFromArray([
                        'quotePrefix' => true,
                    ]);
                }

                $rowNumber = 3;
                $colors = ['F5F5F5', 'FFFFFF']; // Light Sky Blue, White
                foreach ($this->data as $data) {
                    $currentColor = array_shift($colors); // Ambil warna pertama dari daftar
                    array_push($colors, $currentColor); // Masukkan warna tersebut kembali ke akhir daftar
                    $rowStyle = [
                        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $currentColor]],
                    ];
                    $event->sheet->getStyle('A' . $rowNumber . ':AK' . $rowNumber)->applyFromArray($rowStyle);
                    $rowNumber++;
                }
                // Apply colors
                $event->sheet->getStyle('F2:' . 'H' . $highestRow)->applyFromArray(['fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFFFC0C0']]]);
                $event->sheet->getStyle('I2:K' . $highestRow)->applyFromArray(['fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFC0C0FF']]]);
                $event->sheet->getStyle('L2:N' . $highestRow)->applyFromArray(['fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFFFFFC0']]]);
                $event->sheet->getStyle('O2:Q' . $highestRow)->applyFromArray(['fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFC0FFC0']]]);
                $event->sheet->getStyle('R2:T' . $highestRow)->applyFromArray(['fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFFFE0C0']]]);
                $event->sheet->getStyle('U2:W' . $highestRow)->applyFromArray(['fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFC0FFFF']]]);

                // Atur orientasi halaman dan skala cetak
                $event->sheet->getDelegate()->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
                $event->sheet->getDelegate()->getPageSetup()->setFitToWidth(1);
                $event->sheet->getDelegate()->getPageSetup()->setFitToHeight(0);
            },
        ];
    }

    public function title(): string
    {
        return $this->sheet_name;
    }
}
