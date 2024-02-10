<div x-data="{ showModal: @entangle('showInviteModal') }">
    <x-jet-dialog-modal modal="showModal">
        <x-slot name="title">
            Invite Family Member
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="submitInvitation">
                <x-input-label for="name" value="Name" />
                <x-input type="text" wire:model.defer="name" id="name" class="mt-1 block w-full" required />

                <x-input-label for="email" value="Email" />
                <x-input type="email" wire:model.defer="email" id="email" class="mt-1 block w-full" required />

                @if (request()->route()->getName() === 'dashboard')
                    <x-input-label for="relationship" value="Relationship" />
                    <x-select wire:model.defer="relationship" id="relationship" class="mt-1 block w-full">
                        <option value="">Select Relationship</option>
                        <option value="sibling">Sibling</option>
                        <option value="parent">Parent</option>
                        <option value="child">Child</option>
                    </x-select>
                @endif

                <x-button class="mt-4 justify-center" type="submit">Send Invitation</x-button>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$emit('closeModal')">
                Cancel
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
