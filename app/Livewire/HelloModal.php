<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class HelloModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.hello-modal');
    }
}
