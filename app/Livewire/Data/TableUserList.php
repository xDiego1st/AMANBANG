<?php

namespace App\Livewire\Data;

use App\Models\User;
use App\Traits\WithCustomPagination;
use Livewire\Attributes\On;
use Livewire\Component;

class TableUserList extends Component
{
    use WithCustomPagination;

    public $f_role, $jenis_user, $type_validator, $status_account;

    protected $listeners = [
        'reloadTable' => '$refresh',
    ];
    public function render()
    {
        return view('livewire.data.table-user-list', [
            'data' => $this->search()->paginate($this->perPage, ['*'], 'page'),
        ])->layout('layouts.base')->layoutData(['title' => 'Daftar User']);
    }

    public function search()
    {
        $search = '%' . $this->textSearch . '%';
        $query = User::where(function ($query) use ($search) {
            $query->where('name', 'like', $search)
                ->where('role', '!=', "SUPER-ADMIN");
        })->orderBy('created_at', $this->order);

        if ($this->f_role) {
            $query->where('ROLE', $this->f_role);
        }
        if ($this->type_validator) {
            $query->where('type_validator', $this->type_validator);
        }
        $this->totalData = $query->get()->count(); // Menghitung total data sebelum paginasi
        return $query;
    }
    public function openModalDetail($id)
    {
        $this->dispatch('open-modal', targetId: $id);
    }

    public function openModalAsk($action, $id)
    {
        $this->alertEvent("warning", "Apa Kamu Yakin Melakukan " . $action . " pada user #" . User::find($id)->username . "?", "Data yang telah diubah tidak dapat dikembalikan seperti semula, harap gunakan secara hati hati!", "askAction",
            ['action' => $action,
                'id' => $id,
            ]);
    }

    #[On('askAction')]
    public function askAction($data)
    {
        // $data=collect($data);
        if ($data['action'] == "Reset Password") {
            $this->resetPassword($data['id']);
        } else if ($data['action'] == "Reset 2FA") {
            $this->reset2FA($data['id']);
        } else if ($data['action'] == 'Remove Account') {
            $this->delete($data['id']);
        } else {
            $this->alertMessage("error", "?", "?");
        }
    }

    public function reset2FA($id)
    {
        $user = User::find($id);
        $user->two_factor_recovery_codes = null;
        $user->two_factor_confirmed_at = null;
        $user->two_factor_secret = null;
        $user->save();
        $this->alertMessage("success", "Reset 2FA Berhasil", "Reset 2FA Telah Dilakukan pada user #" . $user->username, 2000);
    }
    public function resetPassword($id)
    {
        $user = User::find($id);
        $user->password = bcrypt($user->username . "123");
        $user->save();

        $this->alertMessage("success", "Reset Password Berhasil", "Reset Password Telah Dilakukan pada user # " . $user->username . "Dengan password default:" . $user->username . "123");
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        $this->alertMessage("success", "Remove Account Berhasil", "Remove Account Telah Dilakukan pada user #" . $user->username, 2000);
    }
}
