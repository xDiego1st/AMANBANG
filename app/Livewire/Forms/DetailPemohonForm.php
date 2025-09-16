<?php

namespace App\Livewire\Forms;

use App\Models\DetailPemohon;
use App\Models\Kelurahan;
use App\Models\User;
use App\Traits\WithModelValue;
use App\Traits\WithSweetAlert;
use DB;
use Livewire\Attributes\On;
use Livewire\Form;
use Spatie\LivewireFilepond\WithFilePond;

class DetailPemohonForm extends Form
{
    use WithFilePond;
    use WithModelValue;
    use WithSweetAlert;
    public ?DetailPemohon $dp;
    public $user_id;
    public $nama_bangunan, $fungsi_bangunan, $jenis_konsultasi_bangunan, $permanensi, $jenis_pengajuan, $jumlah_unit, $jumlah_lantai, $luas_lahan, $lokasi_jalan_bangunan, $kelurahan, $koordinat_lokasi;

    public $name, $bertindak_atas_nama, $pekerjaan, $jabatan, $alamat;
    public $files_upload_krk = [];

    protected function rules() // with custom
    {
        $rules = [
            'nama_bangunan' => "required",
            'fungsi_bangunan' => "required|min:4",
            'jenis_konsultasi_bangunan' => "required|min:4",
            'permanensi' => "required",
            'jumlah_unit' => "required",
            'jumlah_lantai' => "required|integer|digits_between:1,2",
            'luas_lahan' => "required|integer|digits_between:1,6",
            'kelurahan' => "required|min:4",
            'lokasi_jalan_bangunan' => "required|min:4",
            'koordinat_lokasi' => [
                'required',
                'regex:/^-?\d{1,2}\.\d+,-?\d{1,3}\.\d+$/',
            ],
            'pekerjaan' => "required",
            'alamat' => "required",
            'name' => "required|min:3",
            'jenis_pengajuan' => "required",
        ];
        if (isset($this->jenis_pengajuan) && $this->jenis_pengajuan == 'PBG') {
            $rules['files_upload_krk'] = 'required';
        }
        return $rules;
    }
    protected function messages()
    {
        return [
            'no_wa.regex' => 'Nomor WhatsApp harus dimulai dengan 62 dan memiliki 10 hingga 13 digit setelah kode negara.',
            'koordinat_lokasi.regex' => 'Format Koordinate Tidak Valid, Format Yang Benar : Lat , Lng Example :0.5078182,101.4662837',

        ];
    }
    //untuk fill update
    public function setDetailPemohon(DetailPemohon $dp)
    {
        $this->nama_bangunan = $dp->nama_bangunan;
        $this->fungsi_bangunan = $dp->fungsi_bangunan;
        $this->jenis_konsultasi_bangunan = $dp->jenis_konsultasi_bangunan;
        $this->permanensi = $dp->permanensi;
        $this->jenis_pengajuan = $dp->jenis_pengajuan;
        $this->jumlah_unit = $dp->jumlah_unit;
        $this->jumlah_lantai = $dp->jumlah_lantai;
        $this->luas_lahan = $dp->luas_lahan;
        $this->lokasi_jalan_bangunan = $dp->lokasi_jalan_bangunan;
        $this->kelurahan = $dp->kelurahan;
        $this->koordinat_lokasi = $dp->koordinat_lokasi;
    }
    public function store()
    {
        DB::beginTransaction(); // Memulai transaksi database
        try {
            $user = User::findOrFail($this->user_id);
            $detailpemohon = DetailPemohon::updateOrCreate([
                'user_id' => $this->user_id ?? auth()->user()->id,
            ], [
                'nama' => $this->name,
                'no_wa' => $user ?? $user->no_wa,
                'jenis_pengajuan' => $this->jenis_pengajuan,
                'team_penilai_ba' => $this->luas_lahan > 72 ? 'TPA' : 'TPT',
                'alamat' => $this->alamat ?? '-',
                'pekerjaan' => $this->pekerjaan ?? '-',
                'bertindak_atas_nama' => $this->bertindak_atas_nama ?? '-',
                'jabatan' => $this->jabatan ?? '-',
                'lokasi_bangunan_jalan' => $this->lokasi_jalan_bangunan ?? '-',
                'lokasi_bangunan_kelurahan' => $this->kelurahan ?? '-',
                'lokasi_bangunan_Kecamatan' => Kelurahan::where('name', $this->kelurahan)->first()?->kecamatan?->nama,
                'jenis_konsultasi_bangunan' => $this->jenis_konsultasi_bangunan ?? '-',
                'fungsi_bangunan' => $this->fungsi_bangunan ?? '-',
                'nama_bangunan' => $this->nama_bangunan ?? '-',
                'jumlah_unit_kavling' => $this->jumlah_unit,
                'jumlah_lantai' => $this->jumlah_lantai,
                'luas_lahan' => $this->luas_lahan,
                'permanensi_bangunan' => $this->permanensi,
            ]);

            // Upload file
            foreach ($this->files_upload_krk as $file) {
                $uploadedFile = $detailpemohon->uploadFile($file, 'upload_syarat_krk', "krk_{$user->username}");
                if (!$uploadedFile) {
                    DB::rollBack(); // Rollback jika gagal upload file
                    return $this->alertMessage('error', 'GAGAL MENGUPLOAD FILE!', 'Server Tidak Merespon File Yang Kamu Upload, Silahkan di Upload lagi!');
                }
            }
            DB::commit(); // Menyimpan semua perubahan dalam database
            $this->alertMessage('success', 'Berhasil Melakukan Pengajuan Permohonan KRK Atas Nama#' . $detailpemohon->nama, 'Data Telah Diteruskan ke Operator untuk Diverifikasi, Mohon Menunggu Berkas untuk Divalidasi. ~ Terimakasih', 10000);
            $this->reset();
        } catch (\Throwable $th) {
            DB::rollBack(); // Rollback jika terjadi kesalahan
            $this->alertMessage('error', 'GAGAL', $th->getMessage());
        }
        $this->reset();
        return true;
    }
    public function update()
    {
        $this->dp->update(

            $this->except('dp')

        );
    }
    public function submitKRK()
    {
        $this->validate();
        $this->alertEvent('warning', 'Apa Kamu Yakin Dengan Informasi Yang Diberikan?', 'Dokumen Yang Telah Disubmit Akan diteruskan kepada Tim Ahli yang terkait untuk proses pemeriksaan dan tidak dapat diubah kembali sampai Tim Ahli terkait selesai memeriksa berkas anda', 'confirmedKRK',
            []);
    }
    #[On('confirmedKRK')]
    public function submit()
    {
        $this->store();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
