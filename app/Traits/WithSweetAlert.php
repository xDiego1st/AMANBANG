<?php

namespace App\Traits;

use Livewire\Attributes\On;

trait WithSweetAlert
{
    public function alertMessage($icon, $title, $text, $timer = 0)
    {
        $this->dispatch('swal:alert',
            icon: $icon,
            title: $title,
            text: $text,
            timer: $timer,
        );
    }

    public function alertEvent($icon, $title, $text, $emitEvent, $data = [])
    {
        $this->dispatch('swal:alert',
            title: $title,
            text: $text,
            icon: $icon,
            showConfirmButton: true,
            showCancelButton: true,
            cancelButtonText: "Tidak",
            confirmButtonText: "Ya",
            emitEvent: $emitEvent, // Nama event yang akan diemit oleh Livewire
            data: $data, // data yang dikirimkan
        );
    }
    public function alertEventTo($icon, $title, $text, $emitEvent, $data = [], $id)
    {
        $this->dispatch(
            'swal:alertto',
            title: $title,
            text: $text,
            icon: $icon,
            showConfirmButton: true,
            showCancelButton: true,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya',
            emitEvent: $emitEvent,
            data: $data,
            componentId: $id, // <<— penting: id instance komponen ini
        );
    }

    public function alertMessageSuccess($textSuccess)
    {

        $this->alertMessage('success', 'Berhasil', $textSuccess, 4000);
    }
    public function alertMessageError($textError)
    {

        $this->alertMessage('error', 'Gagal :(', $textError, 6000);
    }
    public function confirmDialog($do, $id)
    {
        $data['id'] = $id;
        $data['do'] = $do;
        $this->alertEvent('warning', 'Are You Sure?', 'Kamu Akan Melakukan ' . $do . ' Terhadap Data #' . $id, 'confirmAction', $data);
    }

    #[On('showAlert')]
    public function handleAlert($msg)
    {
        $this->alertMessage('success', 'Success', $msg, 5000);
    }
    //NEW METHODE SWEET ALERT WITHOUT JS

    public function confirm(string $method, array $params = [], array $swal = []): void
    {
        // default config swal
        $config = array_merge([
            'title' => 'Apakah kamu yakin?',
            'text' => '',
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonText' => 'Ya',
            'cancelButtonText' => 'Tidak',
            'timer' => null,
            'timerProgressBar' => true,
        ], $swal);

        // aman: encode ke JSON agar karakter spesial tidak bikin JS error
        $jsonConfig = json_encode($config, JSON_UNESCAPED_UNICODE);
        $jsonArgs = json_encode(array_values($params), JSON_UNESCAPED_UNICODE);

        // Eksekusi JS hanya pada instance komponen ini
        $this->js(<<<JS
            Swal.fire($jsonConfig).then((res) => {
                if (res.isConfirmed) {
                    // panggil method Livewire yang dituju, tetap di instance ini
                    \$wire.call('$method', ...$jsonArgs);
                }
            });
        JS);
    }
}
