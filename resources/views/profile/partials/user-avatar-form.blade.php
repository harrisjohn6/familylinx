<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            User Profile Photo
        </h2>

        <img class="rounded-full" width="100" height="100" src="{{ asset('storage/' . $user->profilePhoto) }}">

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Add or update user profile photo
        </p>
    </header>


    @if (session('message'))
        <div class="text-red-500">
            {{ session('message') }}
        </div>
    @endif

    <form method="post" action="{{ route('profile.photo') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="profilePhoto" :value="__('Profile Photo')" />
            <x-text-input id="profilePhoto" name="profilePhoto" type="file" class="mt-1 block w-full"
                :value="old('profilePhoto', $user->profilePhoto)" required autofocus autocomplete="profilePhoto" />
            <x-input-error class="mt-2" :messages="$errors->get('profilePhoto')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
