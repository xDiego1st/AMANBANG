<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use ReflectionClass;

trait WithCustomTraits
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

    // #[On('setProperty')]
    // public function setProperty($property, $value)
    // {
    //     $this->$property = $value;
    // }

    #[On('showAlert')]
    public function handleAlert($msg)
    {
        $this->alertMessage('success', 'Success', $msg, 15000);
    }
    public function setSelectBox($SelectBoxID, $SelectValue)
    {
        $this->dispatch('selectOption',
            selectId: $SelectBoxID,
            selectedValue: $SelectValue
        );
    }

    public function getAllValueProperties()
    {
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);

        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $datapublic[$propertyName] = $this->$propertyName;
        }
        $message = "Nilai variabel publik:\n";
        foreach ($datapublic as $name => $value) {
            $message .= "$name: $value\n";
        }
        return $message;
    }

    public function cleanTemporaryFiles($maxAgeInSeconds = 1800)
    {
        //default 3600 detik = 1 jam
        // Hapus file-file temporari yang melewati waktu tertentu
        collect(Storage::files('livewire-tmp'))
            ->filter(function ($path) use ($maxAgeInSeconds) {
                return now()->diffInSeconds(
                    Carbon::createFromTimestamp(Storage::lastModified($path))
                ) > $maxAgeInSeconds;
            })
            ->each(function ($path) {
                Storage::delete($path);
            });
    }
}
