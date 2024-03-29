<section>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Invite Family Form') }}
            </h2>
        </x-slot>

        @if (session('message'))
            <div class="text-red-500">
                {{ session('message') }}
            </div>
        @endif

        <form id="invite-family" method="post" action="{{ route('invite-family.send') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            <input type="hidden" name="addedFromFamilyId" value={{ auth()->user()->id }}>

            <div>
                <x-input-label for="inviteEmail" :value="__('Email')" />
                <x-text-input id="inviteEmail" name="inviteEmail" type="email" class="mt-1 block w-full"
                    :value="old('inviteEmail')" required autocomplete="InviteEmail" />
                <x-input-error class="mt-2" :messages="$errors->get('InviteEmail')" />
            </div>

            <div>
                <x-input-label for="inviteNameFirst" :value="__('First Name')" />
                <x-text-input id="inviteNameFirst" name="inviteNameFirst" type="text" class="mt-1 block w-full"
                    :value="old('inviteNameFirst')" required autofocus autocomplete="inviteNameFirst" />
                <x-input-error class="mt-2" :messages="$errors->get('inviteNameFirst')" />
            </div>

            <div>
                <x-input-label for="inviteNameMiddle" :value="__('Middle Name')" />
                <x-text-input id="inviteNameMiddle" name="inviteNameMiddle" type="text" class="mt-1 block w-full"
                    :value="old('inviteNameMiddle')" autofocus autocomplete="inviteNameMiddle" />
                <x-input-error class="mt-2" :messages="$errors->get('inviteNameMiddle')" />
            </div>

            <div>
                <x-input-label for="inviteNameLast" :value="__('Last Name')" />
                <x-text-input id="inviteNameLast" name="inviteNameLast" type="text" class="mt-1 block w-full"
                    :value="old('inviteNameLast')" required autofocus autocomplete="inviteNameLast" />
                <x-input-error class="mt-2" :messages="$errors->get('inviteNameLast')" />
            </div>

            <div>
                <x-input-label for="inviteDateBirth" :value="__('Birth Date')" />
                <x-text-input id="inviteDateBirth" name="inviteDateBirth" type="date" class="mt-1 blovk w-full"
                    :value="old('inviteDateBirth')" required autofocus autocomplete="inviteDateBirth" />
                <x-input-error class="mt-2" :messages="$errors->get('inviteDateBirth')" />
            </div>

            <div class="mt-4"> <x-input-label for="inviteBiologicalSex" :value="__('Biological Sex (Optional)')" />
                <select id="inviteBiologicalSex" name="inviteBiologicalSex" class="mt-1 block w-full">
                    <option value="">Select</option>
                    <option value="Male" {{ old('inviteBiologicalSex') == 'Male' ? 'selected' : '' }}>
                        Male</option>
                    <option value="Female" {{ old('inviteBiologicalSex') == 'Female' ? 'selected' : '' }}>
                        Female</option>
                    <option value="Intersex" {{ old('inviteBiologicalSex') == 'Intersex' ? 'selected' : '' }}>
                        Intersex</option>
                    <option value="Unknown" {{ old('inviteBiologicalSex') == 'Unknown' ? 'selected' : '' }}>
                        Unknown</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('inviteBiologicalSex')" />
            </div>

            <div>
                <x-input-label for="inviteRelationshipId" :value="__('Relationship')" />
                <select name="inviteRelationshipId" id="inviteRelationshipId" class="mt-1 block w-full" required
                    autofocus>
                    <option value="">Select relationship Identity</option>
                    @foreach ($relationships as $relationship)
                        <option value="{{ $relationship->id }}"
                            {{ $relationship->id == $relationship->relationship_title ? 'selected' : '' }}>
                            {{ $relationship->relationship_title }}
                        </option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('relationship_title')" />
            </div>

            <div>
                <x-primary-button> {{ __('Send Invite') }} </x-primary-button>
            </div>

        </form>
    </x-app-layout>
</section>
