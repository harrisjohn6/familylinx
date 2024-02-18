<section>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Family Tree') }}
            </h2>
        </x-slot>

        @if (session('message'))
            <div class="text-red-500">
                {{ session('message') }}
            </div>
        @endif

        <div id="familyTree"></div>
        <script src="https://unpkg.com/vis-network/dist/vis-network.min.js"></script>
        <script>
            var nodes = new vis.DataSet(@json($nodes)); //
            var edges = new vis.DataSet(@json($edges));

            var container = document.getElementById('familyTree');
            var data = {
                nodes: nodes,
                edges: edges
            };

            // Simple options to get started
            var options = {
                layout: {
                    hierarchical: { // Experiment with layout choices!
                        direction: 'LR' // Left to Right (or try 'UD' for Up-Down etc.)
                    }
                }
            };
            var network = new vis.Network(container, data, options);
        </script>
    </x-app-layout>
</section>
