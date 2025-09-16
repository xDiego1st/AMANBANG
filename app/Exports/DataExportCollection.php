<?php

namespace App\Exports;

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
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class DataExportCollection implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting, ShouldAutoSize, WithMapping, WithEvents, WithTitle
{
    protected $data;
    protected $rowNumber; // Add this line
    private $sheet_name;
    protected $imagePath;
    public function __construct($data, $sheetName)
    {
        $this->data = $data;
        $this->sheet_name = $sheetName;
    }
    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap',
            'NIK',
            'JK',
            'Tgl Lahir',
            'BB Lahir',
            'TB Lahir',
            'Nama Ortu',
            'Provinsi',
            'Kab/Kota',
            'Kecamatan',
            'puskesmas',
            'desa_kel',
            'posyandu',
            'rt',
            'rw',
            'alamat',
            'usia_saat_ukur',
            'tgl_pengukuran',
            'berat_badan',
            'tinggi_badan',
            'lila',
            'bb_u',
            'zs_bb_u',
            'bb_tb',
            'zs_bb_tb',
            'naik_berat_badan',
            'pmt_diterima',
            'jml_vit_a',
            'kpsp',
            'kia',
            'lat',
            'lng',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => '0', // No
            'B' => '@', // Nama Lengkap
            'C' => '0', // NIK
            'D' => '@', // JK
            'E' => 'yyyy-mm-dd', // Tgl Lahir
            'F' => '0.00', // BB Lahir
            'G' => '0.00', // TB Lahir
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
            'R' => '0', // Usia Saat Ukur
            'S' => 'yyyy-mm-dd', // Tgl Pengukuran
            'T' => '0.00', // Berat Badan
            'U' => '0.00', // Tinggi Badan
            'V' => '0.00', // Lila
            'W' => '@', // BB/U
            'X' => '0.00', // Z-Score BB/U
            'Y' => '@', // BB/TB
            'Z' => '0.00', // Z-Score BB/TB
            'AA' => '@', // Naik Berat Badan
            'AB' => '@', // PMT Diterima
            'AC' => '0', // Jml Vit A
            'AD' => '@', // KPSP
            'AE' => '@', // KIA
            'AF' => '0.0000', // Latitude
            'AG' => '0.0000', // Longitude
        ];
    }
    // public function columnWidths(): array
    // {
    //     return [
    //         'A' => 10, // No
    //         'B' => 40, // Nama Lengkap
    //         'C' => 20, // NIK
    //         'D' => 5, // JK
    //         'E' => 12, // Tgl Lahir
    //         'F' => 10, // BB Lahir
    //         'G' => 10, // TB Lahir
    //         'H' => 40, // Nama Ortu
    //         'I' => 15, // Provinsi
    //         'J' => 15, // Kab/Kota
    //         'K' => 26, // Kecamatan
    //         'L' => 17, // Puskesmas
    //         'M' => 27, // Desa/Kel
    //         'N' => 55, // Posyandu
    //         'O' => 5, // RT
    //         'P' => 5, // RW
    //         'Q' => 25, // Alamat
    //         'R' => 10, // Usia Saat Ukur
    //         'S' => 12, // Tgl Pengukuran
    //         'T' => 10, // Berat Badan
    //         'U' => 10, // Tinggi Badan
    //         'V' => 10, // Lila
    //         'W' => 10, // BB/U
    //         'X' => 10, // Z-Score BB/U
    //         'Y' => 10, // BB/TB
    //         'Z' => 10, // Z-Score BB/TB
    //         'AA' => 15, // Naik Berat Badan
    //         'AB' => 15, // PMT Diterima
    //         'AC' => 10, // Jml Vit A
    //         'AD' => 10, // KPSP
    //         'AE' => 10, // KIA
    //         'AF' => 15, // Latitude
    //         'AG' => 15, // Longitude
    //     ];
    // }

    // Method for Customize  data
    public function map($row): array
    {
        if (!isset($this->rowNumber)) {
            $this->rowNumber = 0;
        }

        ++$this->rowNumber;
        return [
            $this->rowNumber,
            $row->nama,
            $row->nik,
            $row->jk,
            $row->tgl_lahir,
            $row->bb_lahir,
            $row->tb_lahir,
            strtoupper($row->nama_ortu),
            $row->provinsi,
            $row->kab_kota,
            $row->kecamatan,
            $row->puskesmas,
            $row->desa_kel,
            $row->posyandu,
            $row->rt,
            $row->rw,
            $row->alamat,
            $row->usia_saat_ukur,
            $row->tgl_pengukuran,
            $row->berat_badan,
            $row->tinggi_badan,
            $row->lila,
            $row->bb_u,
            $row->zs_bb_u,
            $row->bb_tb,
            $row->zs_bb_tb,
            $row->naik_berat_badan,
            $row->pmt_diterima,
            $row->jml_vit_a,
            $row->kpsp,
            $row->kia,
            $row->lat,
            $row->lng,
        ];
    }
    public function styles($sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                // Atur tinggi baris secara keseluruhan
                for ($row = 1; $row <= $this->data->count() + 1; $row++) { // +1 karena baris header
                    $event->sheet->getRowDimension($row)->setRowHeight(24);
                    // Terapkan gaya ke setiap sel dalam baris
                    $event->sheet->getStyle('A' . $row . ':AG' . $row)->applyFromArray([
                        'font' => [
                            'name' => 'Aptos Display',
                            'size' => '10',
                            // 'bold' => true,
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                            'vertical' => Alignment::VERTICAL_CENTER,
                            'wrapText' => true,
                        ],
                        'quotePrefix' => true,
                    ]);
                }
                // Terapkan gaya pada seluruh baris pertama
                $event->sheet->getStyle('A1:AG1')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => '008000', // Warna hijau
                        ],
                    ],
                    'font' => [
                        'color' => [
                            'rgb' => 'FFFFFF', // Warna putih
                        ],
                    ],
                ]);
                //bold name
                $cellRange = 'B2:B' . $this->data->count()+1; // Atur rentang sel yang akan diberi gaya
                $event->sheet->getStyle($cellRange)->applyFromArray([
                    'font' => [
                        'name' => 'Aptos Display',
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                    'quotePrefix' => true,
                ]);

                $rowNumber = 2;
                $colors = ['F5F5F5', 'FFFFFF']; // Light Sky Blue, White
                foreach ($this->data as $data) {
                    $currentColor = array_shift($colors); // Ambil warna pertama dari daftar
                    array_push($colors, $currentColor); // Masukkan warna tersebut kembali ke akhir daftar
                    $rowStyle = [
                        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $currentColor]],
                    ];
                    $event->sheet->getStyle('A' . $rowNumber . ':AG' . $rowNumber)->applyFromArray($rowStyle);
                    $rowNumber++;
                }

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
