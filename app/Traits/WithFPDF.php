<?php
namespace App\Traits;

use App\Classes\FPDF_AutoWrapTable;
use App\Models\DetailPemohon;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Support\Str;

trait WithFPDF
{
    public function berita_acara_pbg($idpengajuan)
    {
        try {
            // coba decrypt
            $id = decrypt($idpengajuan);
        } catch (DecryptException $e) {
            abort(404, 'ID tidak valid.');
        }

        $query = DetailPemohon::findOrFail($id);
        // eager-load seperlunya
        $query->loadMissing(['pengawas.user.media']);

        // Helper format judul-kata (UTF-8 aman)
        $fmt = fn($v) => $v ? ucwords(mb_strtolower($v, 'UTF-8')) : null;

        // Peta kode dokumen -> label ahli
        $mapKode = [
            '1' => 'arsitektur',
            '2' => 'struktur',
            '3' => 'mekanikal_elektrikal_plumbing',
        ];

        $defaultSign = public_path('images/no_signature3.png');

        // ======================
        // Ambil data Ahli (TPA)
        // ======================
        $ahli = [];
        foreach ($mapKode as $kode => $label) {
            $ver = $query->verifikatorTPAByDok($kode)->with('user.media')->first();
            $user = $ver?->user;

            $ahli["ahli_{$label}"] = $user->name ?? '-';
            $ahli["ttd_ahli_{$label}"] = $user?->getFirstMediaUrl('signature') ?: $defaultSign;
            $ahli["sign_ahli_{$label}"] = $ver->status_verifikator ?? null;
            $ahli["nip_ahli_{$label}"] = $user->nip ?? '-';
        }

        // ======================
        // Ambil data Pengawas
        // ======================
        $pengawasList = $query->pengawas->take(2)->values();

        $pengawas1 = $pengawasList[0]->user ?? null;
        $pengawas2 = $pengawasList[1]->user ?? null;

        $status_pengawas1 = $pengawasList[0]->status_verifikator ?? null;
        $status_pengawas2 = $pengawasList[1]->status_verifikator ?? null;

        $dataPengawas = [
            'pengawas1' => $pengawas1->name ?? '-',
            'nip_pengawas1' => $pengawas1->nip ?? '-',
            'pengawas2' => $pengawas2->name ?? '-',
            'nip_pengawas2' => $pengawas2->nip ?? '-',
            'ttd_pengawas1' => $pengawas1?->getFirstMediaUrl('signature') ?: $defaultSign,
            'ttd_pengawas2' => $pengawas2?->getFirstMediaUrl('signature') ?: $defaultSign,
            'sign_pengawas1' => $status_pengawas1,
            'sign_pengawas2' => $status_pengawas2,
        ];

        // ======================
        // Data utama untuk view
        // ======================
        $data = array_merge([
            'pengajuan_id' => $query->id, // penting untuk verifikasi URL
            'created_at' => $query->created_at, // dipakai untuk nomor BA (tahun)
            'registrasi_pbg' => $query->nomor_registrasi_simbg,
            'nama' => $fmt($query->nama),
            'alamat' => $fmt($query->alamat),
            'bertindak_atas_nama' => $fmt($query->bertindak_atas_nama),
            'pekerjaan' => $fmt($query->pekerjaan),
            'jalan' => $fmt($query->lokasi_bangunan_jalan),
            'kelurahan' => $fmt($query->lokasi_bangunan_kelurahan),
            'kecamatan' => $query->lokasi_bangunan_Kecamatan, // sesuai field-mu
            'jenis_konsultasi_bangunan' => $query->jenis_konsultasi_bangunan,
            'jabatan' => $query->jabatan,
            'fungsi_bangunan' => $query->fungsi_bangunan,
            'nama_bangunan' => $fmt($query->nama_bangunan),
            'jumlah_unit' => $query->jumlah_unit_kavling,
            'jumlah_lantai' => $query->jumlah_lantai,
            'luas_lahan' => $query->luas_lahan,
            'permanensi' => $fmt($query->permanensi_bangunan),
            'team_penilai_ba' => $query->team_penilai_ba,
            'unit_bangunan' => $query->unit_bangunan,
            // tanggal Indonesia
            'tanggal' => Carbon::now()->locale('id')->isoFormat('D MMMM YYYY'),
            'jenis_pengajuan' => $query->jenis_pengajuan ?? '-',
            'nomor_surat_ba' => '640/BAHK-TPA/PBG-PUPR/ 10 / 2025',
        ], $ahli, $dataPengawas);

        $dok = 'berita_acara_tpa';

        try {
            $pdf = new FPDF_AutoWrapTable('P', 'mm', [210, 305], null);
            $pdf->SetTitle('AMANBANG');
            $pdf->SetCreator('amnabang.pekanbaru.go.id');
            $pdf->SetAutoPageBreak(true, 0);

            // judul & properti
            $pdf->SetTitle($data['jenis_pengajuan']);
            $pdf->isUseSignature = true;
            $pdf->AcceptPageBreak();
            $pdf->SetMargins(15, 5);
            $pdf->AddPage();
            if ($pdf->PageNo() > 0) {
                $pdf->skipHeader = true;
                $pdf->SetMargins(15, 5);
            }
            $pdf->AliasNbPages();
            $pdf->skipFooter = false;

            // URL verifikasi (perbaikan: pakai pengajuan_id)
            $verificationUrl = route('dokumen.verifikasi', ['kode' => Crypt::encrypt($data['pengajuan_id'])]);
            $pdf->setVerificationQr($verificationUrl, scale: 5, qrWidthMm: 10);

            // ======================
            // Header BA
            // ======================
            $pdf->SetFont('Times', 'BU', 12);
            $pdf->Cell(0, 5, 'BERITA ACARA HASIL KONSULTASI', 0, 1, 'C');

            $pdf->SetFont('Times', '', 10);
            $tahunBA = Carbon::parse($data['created_at'])->isoformat('Y');
            $pdf->Cell(0, 5, 'Nomor : 640/BAHK-TPA/' . $data['jenis_pengajuan'] . '-PUPR/' . $id . '/' . $tahunBA, 0, 1, 'C');

            $pdf->SetStyle('p', 'Arial', 'N', 10, '0,0,0');
            $pdf->SetStyle('vb', 'Arial', 'B', 0, '0,0,0');
            $pdf->SetStyle('pers', 'Arial', 'I', 0, '0,0,0');
            $pdf->SetStyle('bu', 'Arial', 'BU', 0, '0,0,0');
            if ($data['team_penilai_ba'] == "TPA") {
                $textpembukaan = 'Sesuai dengan jadwal dan tahapan dalam web Sistem Informasi Manajemen Bangunan Gedung (SIMBG), Sekretariat Penyelenggara Bangunan Gedung Dinas Pekerjaan Umum dan Penataan Ruang Kota Pekanbaru dan Tim Profesi Ahli (TPA) telah mengadakan Penilaian Konsultasi terhadap Dokumen Rencana Teknis Permohonan Persetujuan Bangunan Gedung (PBG) melalui web Sistem Informasi Manajemen Bangunan Gedung (SIMBG) dengan data sebagai berikut:';
            } else {
                $textpembukaan = 'Sesuai dengan jadwal dan tahapan dalam web Sistem Informasi Manajemen Bangunan Gedung (SIMBG), Tim Penilai Teknis (TPT) telah mengadakan penilaian Konsultasi terhadap Dokumen Rencana Teknis Permohonan Persetujuan Bangunan Gedung (PBG) melalui web Sistem Informasi Manajemen Bangunan Gedung (SIMBG) dengan data sebagai berikut:';
            }

            $txt = '<p> ' . $textpembukaan . ' </p>';
            $pdf->WriteTag(0, 4.4, $txt, 0, 'J', 0, 1);
            $pdf->Ln(2);

            // ======================
            // I. Data Pemohon
            // ======================
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0, 5, 'I. Data Pemohon', 0, 1);

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(10, 5, '     1.', 0, 0, 'L');
            $pdf->Cell(40, 5, 'Nomor Registrasi PBG', 0, 0, 'L');
            $pdf->Cell(5, 5, ':', 0, 0, 'L');
            $pdf->Cell(0, 5, $data['registrasi_pbg'] ?? '-', 0, 1, 'J');

            $pdf->Cell(10, 5, '     2.', 0, 0, 'L');
            $pdf->Cell(40, 5, 'Nama', 0, 0, 'L');
            $pdf->Cell(5, 5, ':', 0, 0, 'L');
            $pdf->Cell(0, 5, $data['nama'] ?? '-', 0, 1, 'J');

            $pdf->Cell(10, 5, '     3.', 0, 0, 'L');
            $pdf->Cell(40, 5, 'Alamat', 0, 0, 'L');
            $pdf->Cell(5, 5, ':', 0, 0, 'L');
            $pdf->Cell(0, 5, $data['alamat'] ?? '-', 0, 1, 'J');

            $pdf->Cell(10, 5, '     4.', 0, 0, 'L');
            $pdf->Cell(40, 5, 'Pekerjaan', 0, 0, 'L');
            $pdf->Cell(5, 5, ':', 0, 0, 'L');
            $pdf->Cell(0, 5, $data['pekerjaan'] ?? '-', 0, 1, 'J');

            $pdf->Cell(10, 5, '     5.', 0, 0, 'L');
            $pdf->Cell(40, 5, 'Bertindak Atas Nama', 0, 0, 'L');
            $pdf->Cell(5, 5, ':', 0, 0, 'L');
            $pdf->Cell(0, 5, $data['bertindak_atas_nama'] ?? '-', 0, 1, 'J');

            $pdf->Cell(10, 5, '     6.', 0, 0, 'L');
            $pdf->Cell(40, 5, 'Jabatan', 0, 0, 'L');
            $pdf->Cell(5, 5, ':', 0, 0, 'L');
            $pdf->Cell(0, 5, $data['jabatan'] ?? '-', 0, 1, 'J');

            $pdf->Ln(2);

            // ======================
            // II. Data Bangunan
            // ======================
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0, 5, 'II. Data Bangunan', 0, 1);

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(10, 5, '     1.', 0, 0, 'L');
            $pdf->Cell(40, 5, 'Lokasi Bangunan', 0, 1, 'L');

            // Jalan
            $pdf->Cell(20, 5, '             a.', 0, 0, 'L');
            $pdf->Cell(35, 5, 'Jalan', 0, 0, 'L');
            $pdf->Cell(5, 5, ':', 0, 0, 'L');
            $pdf->Cell(0, 5, $data['jalan'] ?? '-', 0, 1, 'J');

            // Kelurahan
            $pdf->Cell(20, 5, '             b.', 0, 0, 'L');
            $pdf->Cell(35, 5, 'Kelurahan', 0, 0, 'L');
            $pdf->Cell(5, 5, ':', 0, 0, 'L');
            $pdf->Cell(0, 5, $data['kelurahan'] ?? '-', 0, 1, 'J');

            // Kecamatan
            $pdf->Cell(20, 5, '             c.', 0, 0, 'L');
            $pdf->Cell(35, 5, 'Kecamatan', 0, 0, 'L');
            $pdf->Cell(5, 5, ':', 0, 0, 'L');
            $pdf->Cell(0, 6, $data['kecamatan'] ?? '-', 0, 1, 'J');

            // Jenis Konsultasi
            $pdf->Cell(10, 5, '     2.', 0, 0, 'L');
            $pdf->Cell(45, 5, 'Jenis Konsultasi Bangunan', 0, 0, 'L');
            $pdf->Cell(5, 5, ':', 0, 0, 'L');
            $pdf->Cell(0, 5, $data['jenis_konsultasi_bangunan'] ?? '-', 0, 1, 'J');

            // Fungsi Bangunan
            $pdf->Cell(10, 5, '     3.', 0, 0, 'L');
            $pdf->Cell(45, 5, 'Fungsi Bangunan', 0, 0, 'L');
            $pdf->Cell(5, 5, ':', 0, 0, 'L');
            $pdf->Cell(0, 5, $data['fungsi_bangunan'] ?? '-', 0, 1, 'J');

            // Nama Bangunan
            $pdf->Cell(10, 5, '     4.', 0, 0, 'L');
            $pdf->Cell(45, 5, 'Nama Bangunan', 0, 0, 'L');
            $pdf->Cell(5, 5, ':', 0, 0, 'L');
            $pdf->Cell(0, 5, $data['nama_bangunan'] ?? '-', 0, 1, 'J');

            // Jumlah Unit
            $pdf->Cell(10, 5, '     5.', 0, 0, 'L');
            $pdf->Cell(45, 5, 'Jumlah Unit/Kavling', 0, 0, 'L');
            $pdf->Cell(10, 5, ':', 0, 0, 'L');
            $pdf->Cell(10, 5, $data['jumlah_unit'] ?? '-', 0, 0, 'L');
            $pdf->Cell(10, 5, 'Unit', 0, 0, 'L');
            $pdf->Cell(15, 5, $data['unit_bangunan'], 0, 1, 'R');

            // Jumlah Lantai
            $pdf->Cell(10, 5, '     6.', 0, 0, 'L');
            $pdf->Cell(45, 5, 'Jumlah Lantai', 0, 0, 'L');
            $pdf->Cell(10, 5, ':', 0, 0, 'L');
            $pdf->Cell(10, 5, $data['jumlah_lantai'] ?? '-', 0, 0, 'J');
            $pdf->Cell(11.5, 5, 'Lantai', 0, 1, 'R');

            // Luas Lahan
            $pdf->Cell(10, 5, '     7.', 0, 0, 'L');
            $pdf->Cell(45, 5, 'Luas Lahan', 0, 0, 'L');
            $pdf->Cell(8, 5, ':', 0, 0, 'L');
            $pdf->Cell(0, 5, ($data['luas_lahan'] ?? '-') . ' ' . utf8_decode('M²'), 0, 1, 'J');

            // Permanensi
            $pdf->Cell(10, 5, '     8.', 0, 0, 'L');
            $pdf->Cell(45, 5, 'Permanensi Bangunan', 0, 0, 'L');
            $pdf->Cell(5, 5, ':', 0, 0, 'L');
            $pdf->Cell(0, 5, $data['permanensi'] ?? '-', 0, 1, 'J');

            $pdf->Ln(2);

            // Hasil Kesimpulan
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(0, 4, 'dengan hasil kesimpulan :', 0, 1);
            $pdf->Cell(0, 5, '1. Dokumen Rencana Bangunan telah memenuhi Standar Teknis Tata Bangunan', 0, 1);
            $pdf->Cell(0, 5, '2. Dokumen Rencana Bangunan telah memenuhi Standar Teknis Arsitektur Bangunan Gedung', 0, 1);
            $pdf->Cell(0, 5, '3. Dokumen Rencana Bangunan telah memenuhi Standar Teknis Struktur Bangunan Gedung', 0, 1);
            $pdf->Cell(0, 5, '4. Dokumen Rencana Bangunan telah memenuhi Standar Teknis Mekanikal, Elektrikal dan Plumbing', 0, 1);
            $pdf->Cell(0, 2, '    Bangunan Gedung', 0, 1);

            $pdf->Ln(1);

            // Footer paragraf
            $pdf->SetStyle('p', 'Arial', 'N', 10, '0,0,0');
            $txt = '<p>Demikian Berita Acara Hasil Konsultasi ini dibuat sebagai bahan untuk proses penerbitan surat Pernyataan Pemenuhan Standar Teknis Persetujuan Bangunan Gedung</p>';
            $pdf->WriteTag(0, 4.6, $txt, 0, 'J', 0, 1);

            $pdf->Ln(1);

            // Dikeluarkan di / Pada Tanggal
            $pdf->SetFont('Arial', '', 9);
            $labelWidth = 40;
            $colonWidth = 5;
            $valueWidth = 50;

            $pdf->Cell(140, 4, 'Dikeluarkan di', 0, 0, 'R');
            $pdf->Cell($colonWidth, 4, ':', 0, 0, 'L');
            $pdf->Cell($valueWidth, 4, 'Pekanbaru', 0, 1, 'L');

            $pdf->Cell(140, 4, 'Pada Tanggal', 0, 0, 'R');
            $pdf->Cell($colonWidth, 4, ':', 0, 0, 'L');
            $pdf->Cell($valueWidth, 4, $data['tanggal'], 0, 1, 'L');

            $pdf->Ln(1);

            if ($data['team_penilai_ba'] == "TPA") {
                // ======================
                // TPA (3 kolom)
                // ======================
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->Cell(176, 4, 'TIM PROFESI AHLI (TPA) ', 0, 1, 'C');
                $pdf->Ln(1);

                $wTTDSide = 44;
                $wTTDCenter = 20;

                $pdf->SetFont('Arial', '', 9);
                $pdf->Cell($wTTDSide, 5, 'Ahli Mekanikal Elektrikal Plumbing', 0, 0, 'C');
                $pdf->Cell($wTTDCenter, 5);
                $pdf->Cell($wTTDSide, 5, 'Ahli Struktur', 0, 0, 'C');
                $pdf->Cell($wTTDCenter, 5);
                $pdf->Cell($wTTDSide, 5, 'Ahli Arsitektur', 0, 0, 'C');
                $pdf->Cell($wTTDCenter, 5);
                $pdf->Ln(18);
                $pdf->Ln(5);

                $imgWidth = 30;
                $imgHeight = 15;
                $yPos = $pdf->GetY() - 17;

                if (($data['sign_ahli_mekanikal_elektrikal_plumbing'] ?? null) == '4') {
                    $pdf->Image($data['ttd_ahli_mekanikal_elektrikal_plumbing'], $pdf->GetX() + ($wTTDSide - $imgWidth) / 2, $yPos, $imgWidth, $imgHeight);
                }
                $pdf->SetFont('Arial', 'BU', 9);
                $pdf->Cell($wTTDSide, 5, $data['ahli_mekanikal_elektrikal_plumbing'] ?? '-', 0, 0, 'C');
                $pdf->Cell($wTTDCenter, 5);

                if (($data['sign_ahli_struktur'] ?? null) == '4') {
                    $pdf->Image($data['ttd_ahli_struktur'], $pdf->GetX() + ($wTTDSide - $imgWidth) / 2, $yPos, $imgWidth, $imgHeight);
                }
                $pdf->SetFont('Arial', 'BU', 9);
                $pdf->Cell($wTTDSide, 5, $data['ahli_struktur'] ?? '-', 0, 0, 'C');
                $pdf->Cell($wTTDCenter, 5);

                if (($data['sign_ahli_arsitektur'] ?? null) == '4') {
                    $pdf->Image($data['ttd_ahli_arsitektur'], $pdf->GetX() + ($wTTDSide - $imgWidth) / 2, $yPos, $imgWidth, $imgHeight);
                }
                $pdf->SetFont('Arial', 'BU', 9);
                $pdf->Cell($wTTDSide, 5, $data['ahli_arsitektur'] ?? '-', 0, 1, 'C');

                // ======================
                // Sekretariat / Pengawas
                // ======================
                $pdf->Ln(5);
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->Cell(176, 4, 'SEKRETARIAT PENYELENGGARA BANGUNAN GEDUNG', 0, 1, 'C');
                $pdf->Ln(1);

                $wTTDSide = 78;
                $wTTDCenter = 0;
                $pdf->SetFont('Arial', '', 9);

                if (empty($data['sign_pengawas2']) || empty($data['pengawas2']) || ($data['pengawas2'] === '-')) {
                    // 1 TTD tengah
                    $pdf->Cell(0, 5, 'Ketua Sekretariat / Pengawas', 0, 1, 'C');

                    $imgWidth = 30;
                    $imgHeight = 15;
                    $yLabel = $pdf->GetY();
                    $yImg = $yLabel + 2;

                    $xLeft = $pdf->GetX();
                    $contentW = $pdf->GetPageWidth() - 2 * $xLeft;
                    $xImg = $xLeft + ($contentW - $imgWidth) / 2;

                    if (($data['sign_pengawas1'] ?? null) == '4' && !empty($data['ttd_pengawas1'])) {
                        $pdf->Image($data['ttd_pengawas1'], $xImg, $yImg, $imgWidth, $imgHeight);
                    }

                    $pdf->Ln(18);
                    $pdf->SetFont('Arial', 'BU', 9);
                    $pdf->Cell(0, 5, $data['pengawas1'] ?? '-', 0, 1, 'C');

                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell(0, 4, 'Nip. ' . ($data['nip_pengawas1'] ?? '-'), 0, 1, 'C');

                } else {
                    // 2 TTD kiri-kanan
                    $pdf->Cell($wTTDSide, 5, 'Pengawas', 0, 0, 'C');
                    $pdf->Cell($wTTDCenter, 5);
                    $pdf->Cell(-$wTTDSide, 5, 'Pengawas', 0, 0, 'C');
                    $pdf->Cell($wTTDCenter, 5);

                    $pdf->Ln(18);
                    $pdf->Ln(5);

                    $imgWidth = 30;
                    $imgHeight = 15;
                    $yPos = $pdf->GetY() - 17;

                    if (($data['sign_pengawas1'] ?? null) == '4' && !empty($data['ttd_pengawas1'])) {
                        $pdf->Image($data['ttd_pengawas1'], $pdf->GetX() + ($wTTDSide - $imgWidth) / 2, $yPos, $imgWidth, $imgHeight);
                    }
                    $pdf->SetFont('Arial', 'BU', 9);
                    $pdf->Cell($wTTDSide, 5, $data['pengawas1'] ?? '-', 0, 0, 'C');
                    $pdf->Cell($wTTDCenter, 5);

                    if (($data['sign_pengawas2'] ?? null) == '4' && !empty($data['ttd_pengawas2'])) {
                        $pdf->Image($data['ttd_pengawas2'], $pdf->GetX() + (-$wTTDSide - $imgWidth) / 2, $yPos, $imgWidth, $imgHeight);
                    }
                    $pdf->SetFont('Arial', 'BU', 9);
                    $pdf->Cell(-$wTTDSide, 5, $data['pengawas2'] ?? '-', 0, 1, 'C');

                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell($wTTDSide, 2, 'Nip. ' . ($data['nip_pengawas1'] ?? '-'), 0, 0, 'C');
                    $pdf->Cell($wTTDCenter, 5);
                    $pdf->Cell(-$wTTDSide, 2, 'Nip. ' . ($data['nip_pengawas2'] ?? '-'), 0, 0, 'C');
                    $pdf->Cell($wTTDCenter, 5);
                }
            } else {
                $pdf->ln(8);
                // ======================
                // TPT (3 kolom)
                // ======================
                $wTTDSide = 44;
                $wTTDCenter = 20;

                $pdf->SetFont('Arial', '', 9);
                $pdf->Cell($wTTDSide, 5, 'Ketua Sekretariat/Pengawas', 0, 0, 'C');
                $pdf->Cell($wTTDCenter, 5);
                $pdf->Cell($wTTDSide, 5, 'Pengawas', 0, 0, 'C');
                $pdf->Cell($wTTDCenter, 5);
                $pdf->Cell($wTTDSide, 5, 'Tim Penilai Teknis', 0, 0, 'C');
                $pdf->Cell($wTTDCenter, 5);
                $pdf->Ln(18);
                $pdf->Ln(5);

                $imgWidth = 30;
                $imgHeight = 15;
                $yPos = $pdf->GetY() - 17;

                if (($data['sign_pengawas1'] ?? null) == '4') {
                    $pdf->Image($data['ttd_pengawas1'], $pdf->GetX() + ($wTTDSide - $imgWidth) / 2, $yPos, $imgWidth, $imgHeight);
                }
                $pdf->SetFont('Arial', 'BU', 9);
                $pdf->Cell($wTTDSide, 5, $data['pengawas1'] ?? '-', 0, 0, 'C');
                $pdf->Cell($wTTDCenter, 5);

                if (($data['sign_pengawas2'] ?? null) == '4') {
                    $pdf->Image($data['ttd_pengawas2'], $pdf->GetX() + ($wTTDSide - $imgWidth) / 2, $yPos, $imgWidth, $imgHeight);
                }
                $pdf->SetFont('Arial', 'BU', 9);
                $pdf->Cell($wTTDSide, 5, $data['pengawas2'] ?? '-', 0, 0, 'C');
                $pdf->Cell($wTTDCenter, 5);

                if (($data['sign_ahli_arsitektur'] ?? null) == '4') {
                    $pdf->Image($data['ttd_ahli_arsitektur'], $pdf->GetX() + ($wTTDSide - $imgWidth) / 2, $yPos, $imgWidth, $imgHeight);
                }
                $pdf->SetFont('Arial', 'BU', 9);
                $pdf->Cell($wTTDSide, 5, $data['ahli_arsitektur'] ?? '-', 0, 1, 'C');

                $pdf->SetFont('Arial', '', 8);
                $pdf->Cell($wTTDSide, 5, 'Nip.' . $data['nip_pengawas1'], 0, 0, 'C');
                $pdf->Cell($wTTDCenter, 5);
                $pdf->Cell($wTTDSide, 5, 'Nip.' . $data['nip_pengawas2'], 0, 0, 'C');
                $pdf->Cell($wTTDCenter, 5);
                $pdf->Cell($wTTDSide, 5, 'Nip.' . $data['nip_ahli_arsitektur'], 0, 0, 'C');
                $pdf->Cell($wTTDCenter, 5);

            }

            $pdf->Output($dok . '.pdf', 'I');
            return true;

        } catch (\Throwable $e) {
            Log::error('Gagal generate PDF ' . $dok . ': ' . $e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    public function saveResultDocument($pdf, $data, $nomorsurat, $dok)
    {
        $user = Auth::user();
        if (!$data->hasMedia($dok)) {
            $filename = $dok . '.pdf';
            $path = storage_path('app/temp/' . $filename);
            $pdf->Output($path, 'F');
            $data->addMedia($path)->usingFileName($filename)->toMediaCollection($dok);
            $data->refresh();
            $nomorsurat->link_file = $data->getMedia($dok)->first()?->getFullUrl();
            $nomorsurat->save();
            $role_has_tte = ['ADMIN-KELURAHAN', 'ADMIN-KECAMATAN'];
            if (in_array($user->role, $role_has_tte)) {
                // dd(4);
                $file = $this->data->getMedia($dok)->first();
                $tempFilePath = storage_path('app/temp/upload_' . uniqid() . '.pdf');

                $attempt = 0;
                $maxAttempts = 3;
                $dataResponse = [];

                do {
                    // Simpan file sementara
                    file_put_contents($tempFilePath, file_get_contents($file->getPath()));

                    // Kirim permintaan tanda tangan ke API eksternal
                    $response = Http::withBasicAuth('rasyid', 'Rasyid123')
                        ->attach('file', file_get_contents($tempFilePath), $file->file_name)
                        ->post('https://esign.pekanbaru.go.id/api/sign/pdf', [
                            'nik' => $user->nik,
                            'passphrase' => $this->password_tte,
                            'tampilan' => 'INVISIBLE',
                            'jenis_response' => 'BASE64',
                        ]);

                    $dataResponse = $response->json();

                    // Jika status_code tidak 1, log dulu tapi JANGAN throw dulu
                    // if (isset($dataResponse['status_code']) && $dataResponse['status_code'] != 1) {
                    //     Log::warning("Percobaan ke-{$attempt} gagal tanda tangan TTE", ['response' => $dataResponse]);
                    // }

                    $attempt++;
                } while (!isset($dataResponse['base64_signed_file']) && $attempt < $maxAttempts);

                // Setelah semua percobaan, cek apakah berhasil
                if (!isset($dataResponse['base64_signed_file'])) {
                    // Jika tidak berhasil juga setelah 3x, baru lempar error terakhir
                    throw new \Exception(json_encode($dataResponse) ?: 'Gagal menandatangani dokumen setelah 3 percobaan.');
                }
                if (file_exists(filename: $tempFilePath)) {
                    unlink(filename: $tempFilePath);
                }
                // dd($dataResponse);
                // Tangani jika respons sukses dan berisi data BASE64
                if (isset($dataResponse['base64_signed_file'])) {
                    $logData = [
                        'status' => 'SUCCESS',
                        'status_code' => $decodedMsg['status_code'] ?? 200,
                        'error_message' => $decodedMsg['error'] ?? null,
                        'document_id' => $dataResponse['id_dokumen'],
                        'signing_message' => $dataResponse['message'],
                        'signing_time' => $dataResponse['signing_time'],
                        'response_payload' => $dataResponse,
                        'action_by' => $user->id,
                    ];
                    $data->logSignDocuments()->create($logData);
                    $signedPdfBase64 = $dataResponse['base64_signed_file'];

                    // Mendekode base64 menjadi konten file
                    $fileContent = base64_decode($signedPdfBase64);

                    // Membuat nama file sementara untuk menyimpan file yang sudah didekode
                    $tempFileName = 'signed-file-' . time() . '.pdf';

                    // Menyimpan file sementara ke storage
                    Storage::disk('local')->put($tempFileName, $fileContent);

                    // Membuat objek UploadedFile dari file sementara
                    $uploadedFile = new UploadedFile(
                        Storage::disk('local')->path($tempFileName),
                        $tempFileName,
                        'application/pdf', // MIME type
                        null, // Error
                        true// Is it test?
                    );

                    // Menggunakan metode uploadedFile untuk menambahkan file ke media collection
                    $uploadedFile = $this->data->uploadedFile($uploadedFile, $dok, $dok);

                    if (!$uploadedFile) {
                        throw new \Exception('Gagal Mengupload File Hasil Dari Base64');
                    }
                    // Perbarui Link URL
                    $nomorsurat->link_file = $this->data->getMedia($dok)->first()?->getFullUrl();
                    $nomorsurat->save();
                    // Opsional: Hapus file sementara setelah berhasil mengupload
                    Storage::disk('local')->delete($tempFileName);

                } else {
                    Log::error('Gagal tanda tangan TTE', ['response' => $dataResponse]);
                    throw new \Exception('Gagal menandatangani dokumen. Kami Tidak Dapat Mengakses Server TTE, Silahkan Coba Lagi!');
                }
            }
        }
    }
}
