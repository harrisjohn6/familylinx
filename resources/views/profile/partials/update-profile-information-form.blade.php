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
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="date_birth" :value="__('Birth Date')" />
            <x-text-input id="date_birth" name="date_birth" type="date" class="mt-1 blovk w-full" :value="old('date_birth', $user->date_birth)"
                required autofocus autocomplete="date_birth" />
            <x-input-error class="mt-2" :messages="$errors->get('date_birth')" />
        </div>

        <div>
            <x-input-label for="gender_id" :value="__('Gender Identity')" />
            <select name="gender_id" id="gender_id" class="mt-1 block w-full" required autofocus>
                <option value="">Select Gender Identity</option>
                @foreach ($genders as $gender)
                    <option value="{{ $gender->gender_id }}"
                        {{ $user->gender_id == $gender->gender_id ? 'selected' : '' }}>
                        {{ $gender->gender_identity }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('gender_identity')" />
        </div>

        <div class="mt-4"> <x-input-label for="biological_sex" :value="__('Biological Sex (Optional)')" />
            <select id="biological_sex" name="biological_sex"  class="mt-1 block w-full">
                <option value="">Select</option>
                <option value="Male" {{ old('biological_sex', $user->biological_sex) == 'Male' ? 'selected' : '' }}>
                    Male</option>
                <option value="Female" {{ old('biological_sex', $user->biological_sex) == 'Female' ? 'selected' : '' }}>
                    Female</option>
                <option value="Intersex"
                    {{ old('biological_sex', $user->biological_sex) == 'Intersex' ? 'selected' : '' }}>Intersex</option>
                <option value="Unknown"
                    {{ old('biological_sex', $user->biological_sex) == 'Unknown' ? 'selected' : '' }}>Unknown</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('biological_sex')" />
        </div>

        <div>
            <x-input-label for="address_line_1" :value="__('Address Line 1')" />
            <x-text-input id="address_line_1" name="address_line_1" type="text" class="mt-1 block w-full"
                :value="old('address_line_1', $user->address_line_1)" required />
            <x-input-error class="mt-2" :messages="$errors->get('address_line_1')" />
        </div>

        <div>
            <x-input-label for="address_line_2" :value="__('Address Line 2 (Optional)')" />
            <x-text-input id="address_line_2" name="address_line_2" type="text" class="mt-1 block w-full"
                :value="old('address_line_2', $user->address_line_2)" />
            <x-input-error class="mt-2" :messages="$errors->get('address_line_2')" />
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
            <x-input-label for="zip_code" :value="__('Zip Code')" />
            <x-text-input id="zip_code" name="zip_code" type="text" class="mt-1 block w-full" :value="old('zip_code', $user->zip_code)"
                required />
            <x-input-error class="mt-2" :messages="$errors->get('zip_code')" />
        </div>


        <div>
            <x-input-label for="phone_type" :value="__('Phone Type')" />
            <select id="phone_type" name="phone_type" class="mt-1 block w-full" required>
                <option value="mobile" {{ $user->phone_type === 'mobile' ? 'selected' : '' }}>Mobile</option>
                <option value="home" {{ $user->phone_type === 'home' ? 'selected' : '' }}>Home</option>
                <option value="work" {{ $user->phone_type === 'work' ? 'selected' : '' }}>Work</option>
                <option value="other" {{ $user->phone_type === 'other' ? 'selected' : '' }}>Other</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('phone_type')" />
        </div>

        <div>
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" name="phone_number" type="tel" class="mt-1 block w-full"
                :value="old('phone_number', $user->phone_number)" required />
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
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
