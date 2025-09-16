<?php

return [
    'dokumen' => [
        1 => ['text' => 'Dokumen Arsitektur & Tata Bangunan', 'class' => 'bg-primary'],
        2 => ['text' => 'Dokumen Struktur Bangunan', 'class' => 'bg-danger'],
        3 => ['text' => 'Dokumen MEP', 'class' => 'bg-warning'],
    ],
    'status_upload' => [
        0 => ['text' => 'On-Waiting', 'class' => 'bg-primary'],
        1 => ['text' => 'On-Checking', 'class' => 'bg-warning'],
        2 => ['text' => 'Need-Correction', 'class' => 'bg-danger'],
        3 => ['text' => 'Complete', 'class' => 'bg-success'],
        4 => ['text' => 'Canceled', 'class' => 'bg-secondary'],
    ],
    'loading_status_upload' => [
        0 => ['v' => '20', 'class' => 'bg-primary'],
        1 => ['v' => '80', 'class' => 'bg-warning'],
        2 => ['v' => '50', 'class' => 'bg-danger'],
        3 => ['v' => '100', 'class' => 'bg-success'],
        4 => ['v' => '0', 'class' => 'bg-secondary'],
    ],
    'keterangan_upload' => [
        0 => ['text' => 'On-Waiting', 'class' => 'bg-primary'],
        1 => ['text' => 'On-Checking', 'class' => 'bg-warning'],
        2 => ['text' => 'Need-Correction', 'class' => 'bg-danger'],
        3 => ['text' => 'Complete', 'class' => 'bg-success'],
        4 => ['text' => 'Canceled', 'class' => 'bg-secondary'],
    ], 'type_validator' => [
        1 => ['text' => 'Ahli Arsitektur', 'class' => 'bg-primary'],
        2 => ['text' => 'Ahli Struktur', 'class' => 'bg-warning'],
        3 => ['text' => 'Ahli Utilitas & Electrical', 'class' => 'bg-danger'],
        4 => ['text' => 'Pemeriksa Tata Bangunan', 'class' => 'bg-success'],
        5 => ['text' => 'Tim Penilai Teknis', 'class' => 'bg-info'],
    ], 'dokumen_verifikator' => [
        1 => ['dok' => '1', 'class' => 'bg-primary'],
        2 => ['dok' => '2', 'class' => 'bg-warning'],
        3 => ['dok' => '3', 'class' => 'bg-danger'],
        4 => ['dok' => '1', 'class' => 'bg-danger'],
    ], 'status_pemohon' => [
        0 => ['text' => 'Diajukan', 'class' => 'bg-secondary'],
        1 => ['text' => 'Dokumen Belum Valid, Dalam Tahap Verifikasi Tim Ahli', 'class' => 'bg-warning'],
        2 => ['text' => 'Menunggu Pengabsahan BA', 'class' => 'bg-primary'],
        3 => ['text' => 'Selesai', 'class' => 'bg-success'],
    ],
];
