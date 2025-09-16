<?php

namespace App\Http\Controllers;

use App\Classes\FPDF_AutoWrapTable;
use App\Models\DetailPemohon;
use App\Models\HistoryUploadDokumenPemohon;
use App\Traits\WithFPDF;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;

class MediaController extends Controller
{
    use WithFPDF;
    public function showMedia($id, $collectionName)
    {
        $data = HistoryUploadDokumenPemohon::findOrFail($id);
        // Periksa apakah koleksi media yang diminta valid
        if (!in_array($collectionName, [
            'upload_arsitektur',
            'upload_stuktur',
            'upload_mep',
        ])) {
            return abort(404);
        }
        // dd($data->getFirstMedia($collectionName));

        // Ambil media dari koleksi yang diminta
        $media = $data->getMedia("upload_arsitektur");
        // Jika tidak ada media, kembalikan respons 404
        if ($media->isEmpty()) {
            return abort(404);
        }

        // Ambil path media pertama dalam koleksi
        $mediaPath = $media[0]->getPath();

        // Mendapatkan tipe media (mimetype)
        $mimeType = mime_content_type($mediaPath);

        // Menentukan nama berkas untuk respons
        $fileName = basename($mediaPath);

        // Kembalikan berkas gambar atau PDF sebagai respons
        return response()->file($mediaPath, ['Content-Type' => $mimeType]);
    }

    public function downloadMedia($id, $collectionName)
    {
        // Cari data pasien berdasarkan ID
        $data = HistoryUploadDokumenPemohon::findOrFail($id);
        // Periksa apakah koleksi media yang diminta valid
        if (!in_array($collectionName, [
            'upload_arsitektur',
            'upload_stuktur',
            'upload_mep',
        ])) {
            return abort(404);
        }

        // Ambil media dari koleksi yang diminta
        $media = $data->getMedia($collectionName);

        // Jika tidak ada media, kembalikan respons 404
        if ($media->isEmpty()) {
            return abort(404);
        }
        // Periksa apakah user adalah pemohon
        $role = Auth()->user()->role;
        //MEMBATASI AKSES

        if ($role == 'PEMOHON' && $data->user_id != Auth()->user()->id) {
            return abort(404);
        }
        // Ambil path media pertama dalam koleksi
        $mediaPath = $media[0]->getPath();

        // Mendapatkan tipe media (mimetype)
        $mimeType = mime_content_type($mediaPath);

        // Menentukan nama berkas untuk respons
        $fileName = basename($mediaPath);

        // Atau, jika ingin mengunduh berkas:
        return response()->download($mediaPath, $fileName, ['Content-Type' => $mimeType]);
    }
    public function generatePDF($idpengajuan){
        return $this->berita_acara_pbg($idpengajuan);
    }
    // public function generatePDF($idpengajuan)
    // {

    //     try {
    //         // coba decrypt
    //         $id = decrypt($idpengajuan);
    //     } catch (DecryptException $e) {
    //         // jika gagal decrypt langsung abort
    //         abort(404, 'ID tidak valid.');
    //     }
    //     $query = DetailPemohon::findOrFail($id);

    //     // (Opsional) pastikan relasi pengawas + user + media sudah tersedia agar hemat query
    //     $query->loadMissing(['pengawas.user.media']);

    //     // Helper format judul-kata (aman UTF-8)
    //     $fmt = fn($v) => $v ? ucwords(mb_strtolower($v, 'UTF-8')) : null;

    //     // Peta kode dokumen -> label ahli
    //     $mapKode = [
    //         '1' => 'arsitektur',
    //         '2' => 'struktur',
    //         '3' => 'mekanikal_elektrikal_plumbing',
    //     ];

    //     $defaultSign = public_path('images/no_signature3.png');

    //     // ======================
    //     // Ambil data Ahli (TPA)
    //     // ======================
    //     $ahli = [];
    //     foreach ($mapKode as $kode => $label) {
    //         // Jika scope mendukung eager-load, boleh tambahkan ->with('user.media')
    //         $ver = $query->verifikatorTPAByDok($kode)->with('user.media')->first();
    //         $user = $ver?->user;

    //         $ahli["ahli_{$label}"] = $user->name ?? '-';
    //         // Ganti 'signatures' ke nama koleksi yang kamu pakai (jika 'signature', samakan)
    //         $ahli["ttd_ahli_{$label}"] = $user?->getFirstMediaUrl('signature') ?: $defaultSign;
    //         $ahli["sign_ahli_{$label}"] = $ver->status_verifikator;
    //     }

    //     // ======================
    //     // Ambil data Pengawas
    //     // ======================
    //     // Ambil maksimal 2 pengawas dari relasi (urutan sesuaikan kebutuhanmu)
    //     $pengawasList = $query->pengawas->take(2)->values(); // sudah di-loadMissing di atas

    //     // Default nilai pengawas
    //     $pengawas1 = $pengawasList[0]->user ?? null;
    //     $pengawas2 = $pengawasList[1]->user ?? null;
    //     if (isset($pengawasList[0])) {
    //         $status_pengawas1 = $pengawasList[0]->status_verifikator;
    //     } else {
    //         $status_pengawas1 = null;
    //     }
    //     if (isset($pengawasList[1])) {
    //         $status_pengawas2 = $pengawasList[1]->status_verifikator;
    //     } else {
    //         $status_pengawas2 = null;
    //     }

    //     $dataPengawas = [
    //         'pengawas1' => $pengawas1->name ?? '-',
    //         'nip_pengawas1' => $pengawas1->nip ?? '-',
    //         'pengawas2' => $pengawas2->name ?? '-',
    //         'nip_pengawas2' => $pengawas2->nip ?? '-',
    //         'ttd_pengawas1' => $pengawas1?->getFirstMediaUrl('signature') ?: $defaultSign,
    //         'ttd_pengawas2' => $pengawas2?->getFirstMediaUrl('signature') ?: $defaultSign,
    //         'sign_pengawas1' => $status_pengawas1,
    //         'sign_pengawas2' => $status_pengawas2,
    //     ];

    //     // ======================
    //     // Data utama untuk view
    //     // ======================
    //     $data = array_merge([
    //         'pengajuan_id' => $query->id,
    //         'registrasi_pbg' => $query->nomor_registrasi_simbg,
    //         'nama' => $fmt($query->nama),
    //         'alamat' => $fmt($query->alamat),
    //         'bertindak_atas_nama' => $fmt($query->bertindak_atas_nama),
    //         'pekerjaan' => $fmt($query->pekerjaan),
    //         'jalan' => $fmt($query->lokasi_bangunan_jalan),
    //         'kelurahan' => $fmt($query->lokasi_bangunan_kelurahan),
    //         'kecamatan' => $query->lokasi_bangunan_Kecamatan, // biarkan sesuai fieldmu
    //         'jenis_konsultasi_bangunan' => $query->jenis_konsultasi_bangunan,
    //         'jabatan' => $query->jabatan,
    //         'fungsi_bangunan' => $query->fungsi_bangunan,
    //         'nama_bangunan' => $fmt($query->nama_bangunan),
    //         'jumlah_unit' => $query->jumlah_unit_kavling,
    //         'jumlah_lantai' => $query->jumlah_lantai,
    //         'luas_lahan' => $query->luas_lahan,
    //         'permanensi' => $fmt($query->permanensi_bangunan),

    //         // Tanggal Indonesia (ubah jika ingin pakai tanggal tertentu)
    //         'tanggal' => Carbon::now()->locale('id')->isoFormat('D MMMM YYYY'),

    //         // Penilai/jenis_pengajuan: sesuaikan sumber datanya (sebelumnya kembar)
    //         'penilai' => 'LIVIA MARLITA, ST, MT',
    //         'jenis_pengajuan' => $query->jenis_pengajuan ?? '-', // <- ganti ke field yg benar

    //         'nomor_surat_ba' => '640/BAHK-TPA/PBG-PUPR/ 10 / 2025',

    //         // Pass row & FPDF sekali saja
    //         '_row' => $query,
    //         'pdf' => new FPDF_AutoWrapTable('P', 'mm', [210, 330], null),
    //     ], $ahli, $dataPengawas);

    //     // ======================
    //     // Render view
    //     // ======================
    //     return $query->team_penilai_ba === 'TPA'
    //     ? view('livewire.page-applicant.berita-acara-tpa', $data)
    //     : view('livewire.page-applicant.berita-acara-tpt', $data);
    // }

    public function downloadOffset($luna)
    {
        if ($luna == "Chronicles") {
            $filePath = public_path('OffsetLuna/Chronicles/OffsetConfiguration.md');
        } else {
            $filePath = public_path('OffsetLuna/Destiny/OffsetConfiguration.md');
        }

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return abort(404, 'File not found.');
        }
    }
}
