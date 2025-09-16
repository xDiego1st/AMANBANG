<?php
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Riskihajar\Terbilang\Facades\Terbilang;

$pdf->SetTitle($_row['jenis_pengajuan']);
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
$pdf->skipFooter = false;
$verificationUrl = route('dokumen.verifikasi', ['kode' => Crypt::encrypt($_row['id'])]);
$pdf->setVerificationQr($verificationUrl, scale: 5, qrWidthMm: 10);

$pdf->SetFont('Times', 'BU', '12');
$pdf->Cell(0, 5, 'BERITA ACARA HASIL KONSULTASI', 0, 1, 'C');
$pdf->SetFont('Times', '', '10');
$pdf->Cell(0, 5, 'Nomor : 640/BAHK-TPA/' . $_row['jenis_pengajuan'] . '-PUPR/' . $pengajuan_id . '/' . Carbon::parse($_row['created_at'])->isoformat('Y'), 0, 1, 'C');
// $pdf->Ln(1);

$pdf->SetStyle('p', 'Arial', 'N', 10, '0,0,0');
$pdf->SetStyle('vb', 'Arial', 'B', 0, '0,0,0');
$pdf->SetStyle('pers', 'Arial', 'I', 0, '0,0,0');
$pdf->SetStyle('bu', 'Arial', 'BU', 0, '0,0,0');

$txt = '<p> Sesuai dengan jadwal dan tahapan dalam web Sistem Informasi Manajemen Bangunan Gedung (SIMBG), Sekretariat Penyelenggara Bangunan Gedung Dinas Pekerjaan Umum dan Penataan Ruang Kota Pekanbaru dan Tim Profesi Ahli (TPA) telah mengadakan Penilian Konsultasi terhadap Dokumen Rencana Teknis Permohonan Persetujuan Bangunan Gedung (PBG) melalui web Sistem Informasi Manajemen Bangunan Gedung (SIMBG) dengan data sebagai berikut: </p>';

$pdf->WriteTag(0, 5, $txt, 0, 'J', 0, 1);
$pdf->Ln(2); // Space

// Data Pemohon
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, 'I. Data Pemohon', 0, 1);

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

$pdf->Ln(2); // Space

// Data Bangunan
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, 'II. Data Bangunan', 0, 1);

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
$pdf->Cell(10, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(10, 5, $jumlah_unit, 0, 0, 'L');
$pdf->Cell(10, 5, 'unit', 0, 0, 'L');
$pdf->Cell(10, 5, 'RTT', 0, 1, 'R');

$pdf->Cell(10, 5, '     6.', 0, 0, 'L');
$pdf->Cell(45, 5, 'Jumlah Lantai', 0, 0, 'L');
$pdf->Cell(10, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(10, 5, $jumlah_lantai, 0, 0, 'J');
$pdf->Cell(10, 5, 'lantai', 0, 1, 'R');

$pdf->Cell(10, 5, '     7.', 0, 0, 'L');
$pdf->Cell(45, 5, 'Luas Lahan', 0, 0, 'L');
$pdf->Cell(8, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(0, 5, $luas_lahan . ' ' . utf8_decode('M²'), 0, 1, 'J');

$pdf->Cell(10, 5, '     8.', 0, 0, 'L');
$pdf->Cell(45, 5, 'Permanensi Bangunan', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'L');
$pdf->SetFont('Arial', '', '10');
$pdf->Cell(0, 5, $permanensi ?? '-', 0, 1, 'J');

$pdf->Ln(2); // Space
// Hasil Kesimpulan
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'dengan hasil kesimpulan :', 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 6, '1. Dokumen Rencana Bangunan telah memenuhi Standar Teknis Tata Bangunan', 0, 1);
$pdf->Cell(0, 6, '2. Dokumen Rencana Bangunan telah memenuhi Standar Teknis Arsitektur Bangunan Gedung', 0, 1);
$pdf->Cell(0, 6, '3. Dokumen Rencana Bangunan telah memenuhi Standar Teknis Struktur Bangunan Gedung', 0, 1);
$pdf->Cell(0, 6, '4. Dokumen Rencana Bangunan telah memenuhi Standar Teknis Mekanikal, Elektrikal dan Plumbing', 0, 1);
$pdf->Cell(0, 3, '    Bangunan Gedung', 0, 1);

$pdf->Ln(2); // Space

// Footer
$pdf->SetStyle('p', 'Arial', 'N', 10, '0,0,0');
$txt = '<p>Demikian Berita Acara Hasil Konsultasi ini dibuat sebagai bahan untuk proses penerbitan surat Pernyataan Pemenuhan Standar Teknis Persetujuan Bangunan Gedung</p>';

$pdf->WriteTag(0, 5, $txt, 0, 'J', 0, 1);

$pdf->Ln(3);

// Atur font
$pdf->SetFont('Arial', '', 9);

// Tentukan lebar kolom
$labelWidth = 40; // lebar untuk label
$colonWidth = 5; // lebar untuk ":"
$valueWidth = 50; // lebar untuk isi (Pekanbaru/tanggal)

// Dikeluarkan di
$pdf->Cell(140, 4, 'Dikeluarkan di', 0, 0, 'R'); // Label di kanan
$pdf->Cell($colonWidth, 4, ':', 0, 0, 'L'); // Titik dua
$pdf->Cell($valueWidth, 4, 'Pekanbaru', 0, 1, 'L'); // Isi rata kiri

// Pada Tanggal
$pdf->Cell(140, 4, 'Pada Tanggal', 0, 0, 'R');
$pdf->Cell($colonWidth, 4, ':', 0, 0, 'L');
$pdf->Cell($valueWidth, 4, $tanggal, 0, 1, 'L');

$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(176, 4, 'TIM PROFESI AHLI (TPA) ', 0, 1, 'C');
$pdf->Ln(1);
$wTTDSide = 44;
$wTTDCenter = 20;
$pdf->SetFont('Arial', '', '9');
$pdf->Cell($wTTDSide, 5, 'Ahli Mekanikal Elektrikal Plumbing', 0, 0, 'C');
$pdf->Cell($wTTDCenter, 5);
$pdf->Cell($wTTDSide, 5, 'Ahli Struktur', 0, 0, 'C');
$pdf->Cell($wTTDCenter, 5);
$pdf->Cell($wTTDSide, 5, 'Ahli Arsitektur', 0, 0, 'C');
$pdf->Cell($wTTDCenter, 5);

$pdf->Ln(18);

$pdf->Ln(5);

// Menentukan posisi gambar dan ukuran gambar
$imgWidth = 30; // Lebar gambar
$imgHeight = 15; // Tinggi gambar
$yPos = $pdf->GetY() - 17; // Posisi Y untuk gambar, sesuaikan dengan jarak antara teks dan gambar

// Menulis gambar di bawah teks Pengawas
if ($sign_ahli_mekanikal_elektrikal_plumbing == '4') {
    $pdf->Image($ttd_ahli_mekanikal_elektrikal_plumbing, $pdf->GetX() + ($wTTDSide - $imgWidth) / 2, $yPos, $imgWidth, $imgHeight);
}
$pdf->SetFont('Arial', 'BU', '9');
$pdf->Cell($wTTDSide, 5, $ahli_mekanikal_elektrikal_plumbing, 0, 0, 'C');
$pdf->Cell($wTTDCenter, 5);

// Menulis gambar di bawah teks Pengawas
if ($sign_ahli_struktur == '4') {
    $pdf->Image($ttd_ahli_struktur, $pdf->GetX() + ($wTTDSide - $imgWidth) / 2, $yPos, $imgWidth, $imgHeight);
}
$pdf->SetFont('Arial', 'BU', '9');
$pdf->Cell($wTTDSide, 5, $ahli_struktur, 0, 0, 'C');
$pdf->Cell($wTTDCenter, 5);

// Menulis gambar di bawah teks Tim Penilai Teknis

if ($sign_ahli_arsitektur == '4') {
    $pdf->Image($ttd_ahli_arsitektur, $pdf->GetX() + ($wTTDSide - $imgWidth) / 2, $yPos, $imgWidth, $imgHeight);
}
$pdf->SetFont('Arial', 'BU', '9');
$pdf->Cell($wTTDSide, 5, $ahli_arsitektur, 0, 1, 'C');

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(176, 4, 'SEKRETARIAT PENYELENGGARA BANGUNAN GEDUNG', 0, 1, 'C');
$pdf->Ln(1);

// Konfigurasi awal (sama seperti punyamu)
$wTTDSide = 78;
$wTTDCenter = 0;

$pdf->SetFont('Arial', '', '9');

// ====== CABANG: 1 TTD (jika pengawas 2 kosong/null) ======
if (empty($sign_pengawas2) || empty($pengawas2)) {
    // Label "Pengawas" di tengah
    $pdf->Cell(0, 5, 'Ketua Sekretariat / Pengawas', 0, 1, 'C');

    // Siapkan ukuran & posisi gambar
    $imgWidth = 30;
    $imgHeight = 15;
    $yLabel = $pdf->GetY(); // Y setelah label
    $yImg = $yLabel - 17; // jarak gambar ke atas label (sesuai punyamu)

    // Hitung tengah area konten tanpa akses margin protected
    $xLeft = $pdf->GetX(); // biasanya ini = margin kiri aktif
    $contentW = $pdf->GetPageWidth() - 2 * $xLeft;
    $xImg = $xLeft + ($contentW - $imgWidth) / 2;

    // Gambar TTD kalau status '4'
    if ($sign_pengawas1 == '4' && !empty($ttd_pengawas1)) {
        $pdf->Image($ttd_pengawas1, $xImg, $yImg, $imgWidth, $imgHeight);
    }

    // Spasi untuk area tanda tangan sebelum nama
    $pdf->Ln(18);

    // Nama & NIP di tengah
    $pdf->SetFont('Arial', 'BU', 9);
    $pdf->Cell(0, 5, $pengawas1, 0, 1, 'C');

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(0, 4, 'Nip. ' . ($nip_pengawas1 ?? '-'), 0, 1, 'C');
} else {
    // ====== CABANG: 2 TTD (pakai kode lamamu yang sudah rapi) ======
    $pdf->Cell($wTTDSide, 5, 'Pengawas', 0, 0, 'C');
    $pdf->Cell($wTTDCenter, 5);
    $pdf->Cell(-$wTTDSide, 5, 'Pengawas', 0, 0, 'C');
    $pdf->Cell($wTTDCenter, 5);

    $pdf->Ln(18);
    $pdf->Ln(5);

    // Menentukan posisi gambar dan ukuran
    $imgWidth = 30;
    $imgHeight = 15;
    $yPos = $pdf->GetY() - 17;

    // Gambar TTD kiri
    if ($sign_pengawas1 == '4' && !empty($ttd_pengawas1)) {
        $pdf->Image($ttd_pengawas1, $pdf->GetX() + ($wTTDSide - $imgWidth) / 2, $yPos, $imgWidth, $imgHeight);
    }

    $pdf->SetFont('Arial', 'BU', 9);
    $pdf->Cell($wTTDSide, 5, $pengawas1, 0, 0, 'C');
    $pdf->Cell($wTTDCenter, 5);

    // Gambar TTD kanan
    if ($sign_pengawas2 == '4' && !empty($ttd_pengawas2)) {
        $pdf->Image($ttd_pengawas2, $pdf->GetX() + (-$wTTDSide - $imgWidth) / 2, $yPos, $imgWidth, $imgHeight);
    }

    $pdf->SetFont('Arial', 'BU', 9);
    $pdf->Cell(-$wTTDSide, 5, $pengawas2, 0, 1, 'C');

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell($wTTDSide, 2, 'Nip. ' . ($nip_pengawas1 ?? '-'), 0, 0, 'C');
    $pdf->Cell($wTTDCenter, 5);
    $pdf->Cell(-$wTTDSide, 2, 'Nip. ' . ($nip_pengawas2 ?? '-'), 0, 0, 'C');
    $pdf->Cell($wTTDCenter, 5);
}

// OUTPUT FILE PDF
$pdf->Output('Berita Acara.pdf', 'I');
exit();
