<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="prefix" :value="__('Prefix')" />
            <x-text-input id="prefix" name="prefix" type="text" class="mt-1 block w-full" :value="old('prefix', $user->prefix)"
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('prefix')" />
        </div>

        <div>
            <x-input-label for="nameFirst" :value="__('First Name')" />
            <x-text-input id="nameFirst" name="nameFirst" type="text" class="mt-1 block w-full" :value="old('nameFirst', $user->nameFirst)"
                autofocus autocomplete="nameFirst" />
            <x-input-error class="mt-2" :messages="$errors->get('nameFirst')" />
        </div>

        <div>
            <x-input-label for="nameMiddle" :value="__('Middle Name')" />
            <x-text-input id="nameMiddle" name="nameMiddle" type="text" class="mt-1 block w-full" :value="old('nameMiddle', $user->nameMiddle)"
                autofocus autocomplete="nameMiddle" />
            <x-input-error class="mt-2" :messages="$errors->get('nameMiddle')" />
        </div>

        <div>
            <x-input-label for="nameLast" :value="__('Last Name')" />
            <x-text-input id="nameLast" name="nameLast" type="text" class="mt-1 block w-full" :value="old('nameLast', $user->nameLast)"
                autofocus autocomplete="nameLast" />
            <x-input-error class="mt-2" :messages="$errors->get('nameLast')" />
        </div>


        <div>
            <x-input-label for="suffix" :value="__('Suffix')" />
            <x-text-input id="suffix" name="suffix" type="text" class="mt-1 block w-full" :value="old('suffix', $user->suffix)"
                autofocus autocomplete="suffix" />
            <x-input-error class="mt-2" :messages="$errors->get('suffix')" />
        </div>

        <div>
            <x-input-label for="dateBirth" :value="__('Birth Date')" />
            <x-text-input id="dateBirth" name="dateBirth" type="date" class="mt-1 blovk w-full" :value="old('dateBirth', $user->dateBirth)"
                required autofocus autocomplete="dateBirth" />
            <x-input-error class="mt-2" :messages="$errors->get('dateBirth')" />
        </div>

        <div>
            <x-input-label for="genderId" :value="__('Gender Identity')" />
            <select name="genderId" id="genderId" class="mt-1 block w-full" required autofocus>
                <option value="">Select Gender Identity</option>
                @foreach ($genders as $gender)
                    <option value="{{ $gender->gender_id }}"
                        {{ $user->genderId == $gender->gender_id ? 'selected' : '' }}>
                        {{ $gender->gender_identity }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('gender_identity')" />
        </div>

        <div class="mt-4"> <x-input-label for="biologicalSex" :value="__('Biological Sex (Optional)')" />
            <select id="biologicalSex" name="biologicalSex" class="mt-1 block w-full">
                <option value="">Select</option>
                <option value="Male" {{ old('biologicalSex', $user->biologicalSex) == 'Male' ? 'selected' : '' }}>
                    Male</option>
                <option value="Female" {{ old('biologicalSex', $user->biologicalSex) == 'Female' ? 'selected' : '' }}>
                    Female</option>
                <option value="Intersex"
                    {{ old('biologicalSex', $user->biologicalSex) == 'Intersex' ? 'selected' : '' }}>Intersex</option>
                <option value="Unknown"
                    {{ old('biologicalSex', $user->biologicalSex) == 'Unknown' ? 'selected' : '' }}>Unknown</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('biologicalSex')" />
        </div>

        <div>
            <x-input-label for="addressLine1" :value="__('Address Line 1')" />
            <x-text-input id="addressLine1" name="addressLine1" type="text" class="mt-1 block w-full"
                :value="old('addressLine1', $user->addressLine1)" required />
            <x-input-error class="mt-2" :messages="$errors->get('addressLine1')" />
        </div>

        <div>
            <x-input-label for="addressLine2" :value="__('Address Line 2 (Optional)')" />
            <x-text-input id="addressLine2" name="addressLine2" type="text" class="mt-1 block w-full"
                :value="old('addressLine2', $user->addressLine2)" />
            <x-input-error class="mt-2" :messages="$errors->get('addressLine2')" />
        </div>

        <div>
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->city)"
                required />
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
        </div>

        <div>
            <x-input-label for="state" :value="__('State')" />
            <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" :value="old('state', $user->state)"
                required />
            <x-input-error class="mt-2" :messages="$errors->get('state')" />
        </div>

        <div>
            <x-input-label for="zip" :value="__('Zip Code')" />
            <x-text-input id="zip" name="zip" type="text" class="mt-1 block w-full" :value="old('zip', $user->zip)"
                required />
            <x-input-error class="mt-2" :messages="$errors->get('zip')" />
        </div>


        <div>
            <x-input-label for="phoneType" :value="__('Phone Type')" />
            <select id="phoneType" name="phoneType" class="mt-1 block w-full" required>
                <option value="mobile" {{ $user->phoneType === 'mobile' ? 'selected' : '' }}>Mobile</option>
                <option value="home" {{ $user->phoneType === 'home' ? 'selected' : '' }}>Home</option>
                <option value="work" {{ $user->phoneType === 'work' ? 'selected' : '' }}>Work</option>
                <option value="other" {{ $user->phoneType === 'other' ? 'selected' : '' }}>Other</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('phoneType')" />
        </div>

        <div>
            <x-input-label for="phoneNumber" :value="__('Phone Number')" />
            <x-text-input id="phoneNumber" name="phoneNumber" type="tel" class="mt-1 block w-full"
                :value="old('phoneNumber', $user->phoneNumber)" required />
            <x-input-error class="mt-2" :messages="$errors->get('phoneNumber')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
