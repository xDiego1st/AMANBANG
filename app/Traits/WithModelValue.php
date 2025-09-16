<?php

namespace App\Traits;

use Livewire\Attributes\On;
// use ReflectionClass;

trait WithModelValue
{
    //untuk menerima data emit javascript tambahkan listener "setProperty"untuk masing masing component yang menggunakan trait ini
    #[On('setProperty')]
    public function setProperty($property, $value)
    {
        $this->$property = $value;
    }

    public function setSelectBox($SelectBoxID, $SelectValue)
    {
        $this->dispatch('selectOption',
            selectId: $SelectBoxID,
            selectedValue: $SelectValue
        );
    }

    // public function getAllValueProperties()
    // {
    //     $reflection = new ReflectionClass($this);
    //     $properties = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);

    //     foreach ($properties as $property) {
    //         $propertyName = $property->getName();
    //         $datapublic[$propertyName] = $this->$propertyName;
    //     }
    //     $message = "Nilai variabel publik:\n";
    //     foreach ($datapublic as $name => $value) {
    //         $message .= "$name: $value\n";
    //     }
    //     return $message;
    // }

}
