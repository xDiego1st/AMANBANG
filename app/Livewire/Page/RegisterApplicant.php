<?php

namespace App\Livewire\Page;

use App\Models\User;
use App\Traits\WithSweetAlert;
use Illuminate\Support\Facades\DB as FacadesDB;
use Livewire\Attributes\On;
use Livewire\Component;

class RegisterApplicant extends Component
{
    use WithSweetAlert;

    public $no_wa, $email, $username, $password;

    public function render()
    {
        return view('livewire.page.register-applicant')->layout('layouts.guest')->layoutData(
            [
                'title' => 'AMANBANG | Aplikasi Manajemen Bangunan Gedung',
            ]);
    }
    protected function rules() // with custom
    {
        $rules = [
            'no_wa' => [
                'required',
                'regex:/^62[0-9]{9,12}$/',
            ],
            'email' => "required|email|unique:users,email",
            'username' => "required|unique:users,username",
            'password' => "required|min:6",
        ];
        return $rules;
    }
    protected function messages()
    {
        return [
            'no_wa.regex' => 'Nomor WhatsApp harus dimulai dengan 62 dan memiliki 10 hingga 13 digit setelah kode negara.',
        ];

    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function submitRegister()
    {
        $this->validate();
        $this->alertEvent('warning', 'Apa Kamu Yakin?', 'Mohon Pastikan anda memasukkan no whatsapp yang aktif, karena kami akan mengirimkan notifikasi melalui whatsapp anda~', 'confirmedRegister',
            []);
    }
    #[On('confirmedRegister')]
    public function submit()
    {

        FacadesDB::beginTransaction(); // Memulai transaksi database
        try {
            $newUser = User::create([
                'username' => $this->username,
                'password' => bcrypt($this->password),
                'email' => $this->email,
                'no_wa' => $this->no_wa,
                'role' => 'PEMOHON',
            ]);

            FacadesDB::commit(); // Menyimpan semua perubahan dalam database
            $this->alertMessage('success', 'Registrasi Berhasil', 'Silahkan Masuk ke AMANBANG ~ Terimakasih', 5000);
            $this->reset();

        } catch (\Throwable $th) {
            FacadesDB::rollBack(); // Rollback jika terjadi kesalahan
            $this->alertMessage('error', 'GAGAL', $th->getMessage());
        }
        try {
            // Kirim pesan WhatsApp
            $msg = "*Pemberitahuan Layanan AMANBANG*\n\nAnda Berhasil Terdaftar , Segera Login & Lengkapi Data Yang Diperlukan untuk *Mengajukan KRK* dan *Verifikasi Dokumen PBG* Percepatan SIMBG \n-----------------------------\n_Pesan Ini dikirim secara automatis. Mohon untuk tidak membalas pesan ini. Terima kasih atas perhatian Anda._";
            $sendMessage = $newUser->sendMessageWA($this->no_wa, $msg);
            if (!$sendMessage) {
                return $this->alertMessage('error', 'GAGAL MENGIRIM PESAN!', 'Gagal Mengirim Pesan WhatsApp.');
            }
        } catch (\Throwable $th) {
            $this->alertMessage('error', 'GAGAL', $th->getMessage());
        }
    }
}
