<?php

namespace App\Livewire\Modals;

use App\Models\User;
use App\Traits\WithModelValue;
use App\Traits\WithSweetAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;

class UserFormModal extends Component
{

    use WithModelValue;
    use WithSweetAlert;
    public $data;

    public $roles = ["ADMIN","BAAS"];
    //

    public $name, $no_wa, $email, $role, $username, $password, $profile_photo_path;
    public function render()
    {
        $this->uniqueId = str::random(8);
        return view('livewire.modals.user-form-modal');
    }
    protected function rules() // with custom
    {
        $rules = [
            'name' => "required|min:4",
            'no_wa' => "nullable|min:11",
            'role' => "required",
            'email' => "required|email|unique:users,email",
        ];
        if (!$this->data) {
            $rules['username'] = "required|min:4|unique:users,username";
            $rules['password'] = "required|min:6";
        }
        return $rules;
    }
    // Function Untuk Menghandle ketika modal ditutup
    #[On('TriggerWhenClosedModals')]
    public function TriggerWhenClosedModals()
    { // untuk mereset ketika modal di close
        $this->reset();
        $this->dispatch('resetSelect2Modal');

    }
    // Function Untuk Menghandle ketika modal ditutup
    #[On('openUserFormModal')]
    public function openUserFormModal($id)
    {
        $this->data = User::findOrFail($id);
        $this->dispatch('open-modal', targetId: "ModalFormUser");

    }
    public function submit()
    {
        $this->validate();
        try {
            if ($this->data) {
                $this->data->name = $this->name;
                $this->data->email = $this->email;
                $this->data->no_hp_pic = $this->no_hp_pic;
                $this->data->save();
                $this->dispatch('close-modal', targetId: "ModalFormUser");
                $this->dispatch('clearFileInputs');
                $this->dispatch('resetSelect');
                $this->dispatch('reloadTable');
                $this->alertMessage('success', 'Berhasil', 'Data Berhasil Di diubah #' . $this->data->name, 3000);
            } else {
                $new = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'username' => $this->username,
                    'password' => bcrypt($this->password),
                    'no_wa' => $this->no_wa,
                    'role' => $this->role,
                ]);
                $this->dispatch('close-modal', targetId: "ModalFormUser");
                $this->dispatch('clearFileInputs');
                $this->dispatch('resetSelect');
                $this->dispatch('reloadTable');
                $this->alertMessage('success', 'Berhasil Menambahkan Account Baru #' . $new->id . '[' . $new->name . ']', 'Account Baru Berhasil Ditambahkan', 3000);
            }

            $this->reset();
        } catch (\Throwable $th) {
            //throw $th;
            $this->alertMessage('error', 'GAGAL', $th->getMessage());
        }
    }
}
