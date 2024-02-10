<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InviteModal extends Component
{
    public string $name = '';
    public string $email = '';
    public string $relationship = ''; // Optional: store selected relationship

    public function render()
    {
        return view('livewire.invite-modal');
    }

    public function submitInvitation()
    {
        // Validation (add rules as needed)
        $this->validateOnly([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'relationship' => 'required|in:sibling,parent,child', // If using relationship selection
        ]);

        // Logic to handle invitation creation and relationship linking
        // ...

        // Close the modal after successful submission
        $this->emit('closeModal');
    }
}
