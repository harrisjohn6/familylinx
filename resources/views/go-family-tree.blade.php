<section>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Family Tree') }}
            </h2>
        </x-slot>
        @csrf

        @if (session('message'))
            <div class="text-red-500">
                {{ session('message') }}
            </div>
        @endif

        <div id="familyTreeDiagram"></div>

        <script>
            var familyData = {
                nodeDataArray: @json(compact('nodeDataArray')),
                linkDataArray: @json(compact('linkDataArray'))
            };
        </script>
    </x-app-layout>
</section>
