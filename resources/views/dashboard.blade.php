<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div id="invite-modal"
        class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 overflow-y-auto h-screen px-4 py-6 sm:px-8">
        <div class="relative bg-white rounded-md px-4 py-5 shadow-lg mx-auto w-full max-w-md">
            <div class="absolute top-3 right-3 close-modal" onclick="closeModal('invite-modal')">&times;</div>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>

</x-app-layout>
