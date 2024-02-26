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

        <div id="familyTree">
        </div>
        <script src="https://unpkg.com/vis-network/dist/vis-network.min.js"></script>

        <script>
            var nodes = new vis.DataSet(@json($nodes)); //
            var edges = new vis.DataSet(@json($edges));

            var container = document.getElementById('familyTree');
            var data = {
                nodes: nodes,
                edges: edges
            };

            var options = {
                nodes: {
                    shape: 'circularImage', // Display images in a circle
                    size: 50 // Adjust image size
                },
                layout: {
                    hierarchical: false
                },
                physics: {
                    enabled: true,
                    solver: 'forceAtlas2Based',
                    hierarchicalRepulsion: {
                        nodeDistance: 200, // Adjust as desired
                        centralGravity: 0.2, // Adjust as desired
                    }
                },
            };

            // Simple options to get started
            const rootNodeId = {{ auth()->user()->id }};

            var network = new vis.Network(container, data, options);
            network.on('stabilized', function() {
                console.log('Layout Stabilized!')
                // Identify and Group Parent Pairs
                nodes.forEach(function(node) {
                    if (node.isParent) {
                        var parents = findParents(node.id);
                        if (parents && parents.length === 2) {
                            var clusterId = parents[0].id + '-' + parents[1].id;
                            groupNodes(clusterId, [node.id, parents[0].id, parents[1]
                                .id
                            ]); // Assuming nodes have an ID field
                        }
                    }
                });
            });

            function findParents(linkedUserId) {
                var parents = [];
                edges.forEach(function(edge) {
                    if (edge.from === linkedUserId || edge.to === linkedUserId) {
                        var otherNodeId = (edge.from === linkedUserId) ? edge.to : edge.from;
                        var otherNode = nodes.get(otherNodeId);
                        if (otherNode && otherNode.isParent) {
                            parents.push(otherNode);
                        }
                    }
                });
                console.log('Parents:', parents)
                return parents;
            }

            function groupNodes(clusterId, nodeIds) {
                const clusterDiv = document.createElement('div');

                clusterDiv.id = `cluster-${clusterId}`;
                console.log('Creating cluster div', clusterId);
                clusterDiv.classList.add("cluster-overlay"); // Add a CSS class for styling
                document.getElementById("familyTree").appendChild(clusterDiv); // Insert into the DOM
                console.log("Cluster ID:", clusterId, "Nodes:", nodeIds);
                //  TODO: Calculate and set position and size of 'clusterDiv' based on 'nodeIds'

                let minX = Infinity,
                    maxX = -Infinity,
                    minY = Infinity,
                    maxY = -Infinity;
                nodeIds.forEach(nodeId => {
                    const node = nodes.get(nodeId);
                    minX = Math.min(minX, node.x);
                    maxX = Math.max(maxX, node.x);
                    minY = Math.min(minY, node.y);
                    maxY = Math.max(maxY, node.y);
                });

                const clusterWidth = maxX - minX;
                const clusterHeight = maxY - minY;
                const clusterCenterX = minX + clusterWidth / 2;

                clusterDiv.style.left = `${clusterCenterX - clusterWidth / 2}px`; // Center the overlay
                clusterDiv.style.top = `${minY - clusterHeight / 2}px`; // Adjust for overlay height
                clusterDiv.style.width = `${clusterWidth}px`;
                clusterDiv.style.height = `${clusterHeight}px`;
            }
        </script>
    </x-app-layout>
</section>
