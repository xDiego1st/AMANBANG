<?php
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Riskihajar\Terbilang\Facades\Terbilang;

$pdf->SetTitle('-');
$pdf->SetAutoPageBreak(true, $pdf->GetPageHeight() - ($pdf->GetPageHeight() - 10));
$pdf->isUseSignature = true;
$pdf->AcceptPageBreak();
$pdf->SetMargins(20, 10);
$pdf->AddPage();
if ($pdf->PageNo() > 0) {
    $pdf->skipHeader = true;
    $pdf->SetMargins(20, 20);
}
$pdf->AliasNbPages();
$pdf->skipFooter = true;

$pdf->SetFont('Times', 'BU', '12');
$pdf->Cell(0, 5, 'BERITA ACARA HASIL KONSULTASI', 0, 1, 'C');
$pdf->SetFont('Times', '', '10');
$pdf->Cell(0, 5, 'Nomor : 640/BAHK-TPT/PBG-PUPR/ 25 / 2024 ', 0, 1, 'C');
$pdf->Ln(4);

$pdf->SetStyle('p', 'Arial', 'N', 10, '0,0,0');
$pdf->SetStyle('vb', 'Arial', 'B', 0, '0,0,0');
$pdf->SetStyle('pers', 'Arial', 'I', 0, '0,0,0');
$pdf->SetStyle('bu', 'Arial', 'BU', 0, '0,0,0');

$txt = '<p> Sesuai dengan jadwal dan tahapan dalam web Sistem Informasi Manajemen Bangunan Gedung (SIMBG), Tim Penilai Teknis (TPT) telah mengadakan Penilaian Konsultasi terhadap Dokumen Rencana Teknis Permohonan Persetujuan Bangunan Gedung (PBG) melalui web Sistem Informasi Manajemen Bangunan Gedung (SIMBG) dengan data sebagai berikut: </p>';

$pdf->WriteTag(0, 4, $txt, 0, 'J', 0, 1);
$pdf->Ln(5); // Space

// Data Pemohon
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 4, 'I. Data Pemohon', 0, 1);

$pdf->SetFont('Arial', '', '10');
$pdf->Cell(10, 5, '     1.', 0, 0, 'L');
$pdf->Cell(40, 5, 'Nomor Registrasi PBG', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(0, 5, $registrasi_pbg ?? '-', 0, 1, 'J');

$pdf->Cell(10, 5, '     2.', 0, 0, 'L');
$pdf->Cell(40, 5, 'Nama', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(0, 5, $nama ?? '-', 0, 1, 'J');

$pdf->Cell(10, 5, '     3.', 0, 0, 'L');
$pdf->Cell(40, 5, 'Alamat', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(0, 5, $alamat ?? '-', 0, 1, 'J');

$pdf->Cell(10, 5, '     4.', 0, 0, 'L');
$pdf->Cell(40, 5, 'Pekerjaan', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(0, 5, $pekerjaan ?? '-', 0, 1, 'J');

$pdf->Cell(10, 5, '     5.', 0, 0, 'L');
$pdf->Cell(40, 5, 'Bertindak Atas Nama', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(0, 5, $bertindak_atas_nama ?? '-', 0, 1, 'J');

$pdf->Cell(10, 5, '     6.', 0, 0, 'L');
$pdf->Cell(40, 5, 'Jabatan', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(0, 5, $jabatan ?? '-', 0, 1, 'J');

$pdf->Ln(5); // Space

// Data Bangunan
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 4, 'II. Data Bangunan', 0, 1);

$pdf->SetFont('Arial', '', '10');
$pdf->Cell(10, 5, '     1.', 0, 0, 'L');
$pdf->Cell(40, 5, 'Lokasi Bangunan', 0, 1, 'L');

//Jalan
$pdf->Cell(20, 5, '             a.', 0, 0, 'L');
$pdf->Cell(35, 5, 'Jalan', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(0, 5, $jalan ?? '-', 0, 1, 'J');
//
$pdf->Cell(20, 5, '             a.', 0, 0, 'L');
$pdf->Cell(35, 5, 'Kelurahan', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(0, 5, $kelurahan ?? '-', 0, 1, 'J');
//
$pdf->Cell(20, 5, '             a.', 0, 0, 'L');
$pdf->Cell(35, 5, 'Kecamatan', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(0, 6, $kecamatan ?? '-', 0, 1, 'J');
//

$pdf->Ln(2); // Space
$pdf->Cell(10, 5, '     2.', 0, 0, 'L');
$pdf->Cell(45, 5, 'Jenis Konsultasi Bangunan', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(0, 5, $jenis_konsultasi_bangunan ?? '-', 0, 1, 'J');

$pdf->Cell(10, 5, '     3.', 0, 0, 'L');
$pdf->Cell(45, 5, 'Fungsi Bangunan', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(0, 5, $fungsi_bangunan ?? '-', 0, 1, 'J');

$pdf->Cell(10, 5, '     4.', 0, 0, 'L');
$pdf->Cell(45, 5, 'Nama Bangunan', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(0, 5, $nama_bangunan ?? '-', 0, 1, 'J');

$pdf->Cell(10, 5, '     5.', 0, 0, 'L');
$pdf->Cell(45, 5, 'Jumlah Unit/Kavling', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(0, 5, $jumlah_unit . ' Unit Rumah' ?? '-', 0, 1, 'J');

$pdf->Cell(10, 5, '     6.', 0, 0, 'L');
$pdf->Cell(45, 5, 'Jumlah Lantai', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(0, 5, $jumlah_lantai . ' lantai' ?? '-', 0, 1, 'J');

$pdf->Cell(10, 5, '     7.', 0, 0, 'L');
$pdf->Cell(45, 5, 'Luas Lahan', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(0, 5, $luas_lahan . ' ' . utf8_decode('m²'), 0, 1, 'J');

$pdf->Cell(10, 5, '     8.', 0, 0, 'L');
$pdf->Cell(45, 5, 'Permanensi Bangunan', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(0, 5, $permanensi ?? '-', 0, 1, 'J');

$pdf->Ln(5); // Space
// Hasil Kesimpulan
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'dengan hasil kesimpulan:', 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 7, '1. Dokumen Rencana Bangunan telah memenuhi Standar Teknis Tata Bangunan', 0, 1);
$pdf->Cell(0, 7, '2. Dokumen Rencana Bangunan telah memenuhi Standar Teknis Arsitektur Bangunan Gedung', 0, 1);
$pdf->Cell(0, 7, '3. Dokumen Rencana Bangunan telah memenuhi Standar Teknis Struktur Bangunan Gedung', 0, 1);
$pdf->Cell(0, 7, '4. Dokumen Rencana Bangunan telah memenuhi Standar Teknis Mekanikal, Elektrikal dan Plumbing', 0, 1);
$pdf->Cell(0, 1, '    Bangunan Gedung', 0, 1);

$pdf->Ln(5); // Space

// Footer
$pdf->SetStyle('p', 'Arial', 'N', 10, '0,0,0');
$txt = '<p>Demikian Berita Acara Hasil Konsultasi ini dibuat sebagai bahan untuk proses penerbitan surat Pernyataan Pemenuhan Standar Teknis Persetujuan Bangunan Gedung</p>';

$pdf->WriteTag(0, 4, $txt, 0, 'J', 0, 1);

$pdf->Ln(10);

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(140, 4, 'Dikeluarkan di ', 0, 0, 'R');
$pdf->Cell(2, 4, ':', 0, 0, 'R');
$pdf->SetFont('Arial', '', '9');
$pdf->Cell(0, 4, 'Pekanbaru', 0, 1, 'R');

$pdf->Cell(140, 4, 'Pada Tanggal ', 0, 0, 'R');
$pdf->Cell(2, 4, ':', 0, 0, 'R');
$pdf->SetFont('Arial', '', '9');
$pdf->Cell(0, 4, $tanggal ?? '-', 0, 1, 'R');

$pdf->Ln(10);

$wTTDSide = 44;
$wTTDCenter = 20;
$pdf->SetFont('Arial', '', '9');
$pdf->Cell($wTTDSide, 5, 'Pengawas', 0, 0, 'C');
$pdf->Cell($wTTDCenter, 5);
$pdf->Cell($wTTDSide, 5, 'Pengawas', 0, 0, 'C');
$pdf->Cell($wTTDCenter, 5);
$pdf->Cell($wTTDSide, 5, 'Tim Penilai Teknis', 0, 0, 'C');
$pdf->Cell($wTTDCenter, 5);

$pdf->Ln(18);

$fs = 12;
$lengthCompanyName = 12;

$pdf->Ln(5);

// Menentukan posisi gambar dan ukuran gambar
$imgWidth = 30; // Lebar gambar
$imgHeight = 15; // Tinggi gambar
$yPos = $pdf->GetY() - 17; // Posisi Y untuk gambar, sesuaikan dengan jarak antara teks dan gambar

// Menulis gambar di bawah teks Pengawas
$pdf->Image(public_path('images/LOGO-PUPR.png'), $pdf->GetX() + ($wTTDSide - $imgWidth) / 2, $yPos, $imgWidth, $imgHeight);
$pdf->SetFont('Arial', 'BU', '9');
$pdf->Cell($wTTDSide, 5, 'TUSWAN AIDI, ST, MT', 0, 0, 'C');
$pdf->Cell($wTTDCenter, 5);

// Menulis gambar di bawah teks Pengawas
$pdf->Image(public_path('images/LOGO-PUPR.png'), $pdf->GetX() + ($wTTDSide - $imgWidth) / 2, $yPos, $imgWidth, $imgHeight);
$pdf->SetFont('Arial', 'BU', '9');
$pdf->Cell($wTTDSide, 5, 'ARDIANSYAH, ST', 0, 0, 'C');
$pdf->Cell($wTTDCenter, 5);

// Menulis gambar di bawah teks Tim Penilai Teknis
$pdf->Image(public_path('images/LOGO-PUPR.png'), $pdf->GetX() + ($wTTDSide - $imgWidth) / 2, $yPos, $imgWidth, $imgHeight);
$pdf->SetFont('Arial', 'BU', '9');
$pdf->Cell($wTTDSide, 5, 'LIVIA MARLITA,ST,MT', 0, 1, 'C');

$pdf->SetFont('Arial', '', '8');
$pdf->Cell($wTTDSide, 2, 'Nip. 197404052009031002 ', 0, 0, 'C');
$pdf->Cell($wTTDCenter, 5);
$pdf->Cell($wTTDSide, 2, 'Nip. 197311162006041016', 0, 0, 'C');
$pdf->Cell($wTTDCenter, 5);
$pdf->Cell($wTTDSide, 2, 'Nip. 19751242001122001', 0, 1, 'C');
$pdf->Cell($wTTDCenter, 5);

// OUTPUT FILE PDF
$pdf->Output('Berita Acara.pdf', 'I');
exit();
