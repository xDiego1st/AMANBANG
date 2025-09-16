<?php

namespace App\Livewire\PageApplicant;

use App\Models\DetailPemohon;
use App\Models\Kelurahan;
use App\Models\User;
use App\Traits\WithModelValue;
use App\Traits\WithSweetAlert;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\LivewireFilepond\WithFilePond;

class FormPageDataPemohon extends Component
{
    use WithFilePond;
    use WithModelValue;
    use WithSweetAlert;
    public $uniqueId;
    public $data;
    //field input

    public $nama_bangunan, $fungsi_bangunan, $jenis_konsultasi_bangunan, $jumlah_unit, $jumlah_lantai, $luas_lahan, $permanensi, $lokasi_jalan_bangunan, $kelurahan, $team_penilai_berita_acara, $rencana_jenis_kegiatan, $judul_kbli, $no_kbli,
    $kepemilikan_tanah, $koordinat_lokasi, $jenis_pengajuan, $unit_bangunan;
    public $files_upload_krk = [];
    public $nomor_registrasi_simbg, $name, $bertindak_atas_nama, $pekerjaan, $jabatan, $alamat, $no_wa, $email, $username, $password, $profile_photo_path;
    public $fungsi_bangunan_list = ['Bangunan', 'Unian', 'Usaha', 'Sosial dan Budaya', 'Campuran', 'Keagamaan', 'Khusus'];
    public $team_penilai_list = ['Team Penilai Ahli', 'Team Penilai Teknis'];
    public $pekerjaan_list = [
        'Belum/Tidak Bekerja',
        'Mengurus Rumah Tangga',
        'Pelajar/Mahasiswa',
        'Wiraswasta',
        'Pensiunan',
        'Dosen',
        'Guru',
        'Pegawai Negeri Sipil (PNS)',
        'Tentara Nasional Indonesia (TNI)',
        'Kepolisian RI (POLRI)',
        'Akuntan',
        'Anggota BPK',
        'Anggota DPR-RI',
        'Anggota DPRD Kabupaten/Kota',
        'Anggota DPRD Provinsi',
        'Anggota DPD',
        'Anggota Kabinet Kementerian',
        'Anggota Mahkamah Konstitusi',
        'Apoteker',
        'Arsitek',
        'Bidan',
        'Biarawati',
        'Bupati',
        'Buruh Harian Lepas',
        'Buruh Nelayan/Perikanan',
        'Buruh Peternakan',
        'Buruh Tani/Perkebunan',
        'Dokter',
        'Duta Besar',
        'Gubernur',
        'Imam Masjid',
        'Industri',
        'Juru Masak',
        'Karyawan BUMD',
        'Karyawan BUMN',
        'Karyawan Honorer',
        'Karyawan Swasta',
        'Kepala Desa',
        'Konstruksi',
        'Konsultan',
        'Mekanik',
        'Nelayan/Perikanan',
        'Notaris',
        'Paraji',
        'Paranormal',
        'Pastor',
        'Pedagang',
        'Pelaut',
        'Pembantu Rumah Tangga',
        'Pekerjaan',
        'Penata Busana',
        'Penata Rambut',
        'Penata Rias',
        'Penderma',
        'Pendeta',
        'Penerjemah',
        'Pengacara',
        'Peneliti',
        'Penyiar Radio',
        'Penyiar Televisi',
        'Perancang Busana',
        'Perangkat Desa',
        'Perawat',
        'Perdagangan',
        'Petani/Pekebun',
        'Peternak',
        'Pialang',
        'Pilot',
        'Presiden',
        'Promotor Acara',
        'Psikiater/Psikolog',
        'Seniman',
        'Sopir',
        'Swasta',
        'Tabib',
        'Transportasi',
        'Tukang Batu',
        'Tukang Cukur',
        'Tukang Jahit',
        'Tukang Kayu',
        'Tukang Las/Pandai Besi',
        'Tukang Listrik',
        'Tukang Sol Sepatu',
        'Ustadz/Mubaligh',
        'Wakil Bupati',
        'Wakil Gubernur',
        'Wakil Presiden',
        'Wakil Walikota',
        'Walikota',
        'Wartawan',
        'Lainnya',
    ];
    public $pengajuan_list = ['PBG'];
    public $list_kelurahan = [];

    public $permanensi_list = ['Permanen', 'Sementara'];
    public $unit_bangunan_list = ['RTT', 'Gedung'];
    public $jenis_rumah_list = ['Rumah Tinggal Tidak Sederhana', 'Rumah Tinggal Sederhana', 'Bangunan Gedung Kepentingan Umum','Rumah Tinggal 1 lantai luas maksimal72 m2'];

    #[Locked]
    public $ids;
    public function mount()
    {
        $this->uniqueId = str::random(8);
        $this->list_kelurahan = Kelurahan::all();
        $this->name = auth()->user()->name;
        if ($this->ids) {
            $this->data = DetailPemohon::findOrFail($this->ids);
            if ($this->data) {
                $this->setDetailPemohon($this->data);
            }
        }
    }

    public function render()
    {
        return view('livewire.page-applicant.form-page-data-pemohon')->layout('layouts.base')->layoutData(
            [
                'title' => 'APLIKASI MANAJEMEN BANGUNAN GEDUNG',
            ]);
    }
    public function submitKRK()
    {
        $this->validate();
        $this->alertEvent('warning', 'Apa Kamu Yakin Dengan Informasi Yang Diberikan?', 'Dokumen KRK dan Data Pembangunan Yang Telah Diberikan Akan diteruskan kepada Operator AMANBANG untuk proses pemeriksaan dan tidak dapat diubah kembali', 'confirmedKRK',
            []);
    }
    #[On('confirmedKRK')]
    public function submit()
    {
        FacadesDB::beginTransaction(); // Memulai transaksi database
        try {
            if ($this->data) {
                // Update data
                $detailpemohon = DetailPemohon::find($this->ids);
                if ($detailpemohon) {
                    $detailpemohon->update([
                        'nama' => $this->name,
                        'jenis_pengajuan' => $this->jenis_pengajuan,
                        'team_penilai_ba' => $this->luas_lahan > 72 ? 'TPA' : 'TPT',
                        'alamat' => $this->alamat ?? '-',
                        'pekerjaan' => $this->pekerjaan ?? '-',
                        'bertindak_atas_nama' => $this->bertindak_atas_nama ?? '-',
                        'jabatan' => $this->jabatan ?? '-',
                        'lokasi_bangunan_jalan' => $this->lokasi_jalan_bangunan ?? '-',
                        'lokasi_bangunan_kelurahan' => $this->kelurahan,
                        'lokasi_bangunan_kecamatan' => Kelurahan::where('name', $this->kelurahan)->first()?->kecamatan?->nama,
                        'jenis_konsultasi_bangunan' => $this->jenis_konsultasi_bangunan ?? '-',
                        'fungsi_bangunan' => $this->fungsi_bangunan ?? '-',
                        'nama_bangunan' => $this->nama_bangunan ?? '-',
                        'jumlah_unit_kavling' => $this->jumlah_unit,
                        'jumlah_lantai' => $this->jumlah_lantai,
                        'luas_lahan' => $this->luas_lahan,
                        'permanensi_bangunan' => $this->permanensi,
                        'koordinat_lokasi' => $this->koordinat_lokasi,
                    ]);
                }
                $noticetitle = 'Update Data Berhasil';
                $noticedesc = 'Data yang Anda ubah telah berhasil diperbarui dalam sistem dan tersimpan dengan aman.';
            } else {
                $user = Auth()->User();
                // Create
                $detailpemohon = DetailPemohon::create([
                    'user_id' => $user->id,
                    'nama' => $this->name,
                    'no_wa' => $user->no_wa,
                    'jenis_pengajuan' => $this->jenis_pengajuan,
                    'team_penilai_ba' => $this->luas_lahan > 72 ? 'TPA' : 'TPT',
                    'alamat' => $this->alamat ?? '-',
                    'pekerjaan' => $this->pekerjaan ?? '-',
                    'bertindak_atas_nama' => $this->bertindak_atas_nama ?? '-',
                    'jabatan' => $this->jabatan ?? '-',
                    'lokasi_bangunan_jalan' => $this->lokasi_jalan_bangunan ?? '-',
                    'lokasi_bangunan_kelurahan' => $this->kelurahan,
                    'lokasi_bangunan_Kecamatan' => Kelurahan::where('name', $this->kelurahan)->first()?->kecamatan?->nama,
                    'jenis_konsultasi_bangunan' => $this->jenis_konsultasi_bangunan ?? '-',
                    'fungsi_bangunan' => $this->fungsi_bangunan ?? '-',
                    'nama_bangunan' => $this->nama_bangunan ?? '-',
                    'jumlah_unit_kavling' => $this->jumlah_unit,
                    'unit_bangunan' => $this->unit_bangunan,
                    'jumlah_lantai' => $this->jumlah_lantai,
                    'luas_lahan' => $this->luas_lahan,
                    'permanensi_bangunan' => $this->permanensi,
                    'koordinat_lokasi' => $this->koordinat_lokasi,
                ]);
                // Upload file
                foreach ($this->files_upload_krk as $file) {
                    $uploadedFile = $detailpemohon->uploadFile($file, 'upload_syarat_krk', "krk_{$user->username}");
                    if (!$uploadedFile) {
                        FacadesDB::rollBack(); // Rollback jika gagal upload file
                        return $this->alertMessage('error', 'GAGAL MENGUPLOAD FILE!', 'Server Tidak Merespon File Yang Kamu Upload, Silahkan di Upload lagi!');
                    }
                }
                $noticetitle = 'Berhasil Melakukan Pengajuan Permohonan KRK Atas Nama#' . $detailpemohon->nama;
                $noticedesc = 'Data Telah Diteruskan ke Operator untuk Diverifikasi, Mohon Menunggu Berkas untuk Divalidasi. ~ Terimakasih';
            }
            FacadesDB::commit(); // Menyimpan semua perubahan dalam database
            $this->dispatch('refreshtable');
            $this->dispatch('close-modal', targetId: "modalsPendataanPengajuanPemohon");
            $this->alertMessage('success', $noticetitle, $noticedesc, 10000);
            $this->reset();
            $successMessage = 'Pengajuan Telah Diteruskan kepada operator AMANBANG, Mohon Menunggu 1 Hari Kerja , Anda Akan Menerima Notifikasi Pemberitahuan Melalui WA apabila Dokumen KRK Telah Diterbitkan ';
            session()->flash('alert', $successMessage);
            $this->redirectRoute('dashboard');
        } catch (\Throwable $th) {
            FacadesDB::rollBack(); // Rollback jika terjadi kesalahan
            $this->alertMessage('error', 'GAGAL', $th->getMessage());
        }
    }

    protected function rules() // with custom
    {
        $rules = [
            'nama_bangunan' => "required",
            'fungsi_bangunan' => "required|min:4",
            'jenis_konsultasi_bangunan' => "required|min:4",
            'permanensi' => "required",
            'jumlah_unit' => "required|integer|digits_between:1,2",
            'unit_bangunan' => "required",
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
        if (isset($this->jenis_pengajuan) && $this->jenis_pengajuan == 'PBG' && !$this->data) {
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
    public function DownloadFormulirKRK()
    {
        $filePath = public_path('images/TemplateForm/Formulir Permohonan KRK.pdf');
        $fileName = 'Formulir Permohonan KRK.pdf';

        return response()->streamDownload(function () use ($filePath) {
            readfile($filePath);
        }, $fileName, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $fileName . '"',
        ]);
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function setDetailPemohon($dp)
    {
        $this->nama_bangunan = $dp?->nama_bangunan;
        $this->fungsi_bangunan = $dp?->fungsi_bangunan;
        $this->jenis_konsultasi_bangunan = $dp?->jenis_konsultasi_bangunan;
        $this->permanensi = $dp?->permanensi_bangunan;
        $this->jenis_pengajuan = $dp?->jenis_pengajuan;
        $this->jumlah_unit = $dp?->jumlah_unit_kavling;
        $this->jumlah_lantai = $dp?->jumlah_lantai;
        $this->luas_lahan = $dp?->luas_lahan;
        $this->lokasi_jalan_bangunan = $dp?->lokasi_bangunan_jalan;
        $this->kelurahan = $dp?->lokasi_bangunan_kelurahan;
        $this->koordinat_lokasi = $dp?->koordinat_lokasi;
        //
        $this->name = $dp?->nama;
        $this->bertindak_atas_nama = $dp?->bertindak_atas_nama;
        $this->pekerjaan = $dp?->pekerjaan;
        $this->jabatan = $dp?->jabatan;
        $this->alamat = $dp?->alamat;
    }
}
