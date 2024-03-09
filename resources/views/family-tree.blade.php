<section>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Family Tree') }}
            </h2>

            <head>
                <style>
                    /* Style your menu as needed */
                </style>
            </head>

        </x-slot>
        @csrf

        @if (session('message'))
            <div class="text-red-500">
                {{ session('message') }}
            </div>
        @endif

        <div id="familyTree"></div>

        <div id="contextMenu">
            <h3 id="contextMenuTitle"></h3>
            <ul>
                <li id="addProfilePhoto">Add Profile Photo</li>
                <li id="addFamilyMember">Add Family Member</li>
                <li id="editProfile">Edit Profile</li>
            </ul>
        </div>

        <script src="https://unpkg.com/vis-network/dist/vis-network.min.js"></script>

        <script>
            const rootNodeId = {{ auth()->user()->id }};

            var nodes = new vis.DataSet(@json($nodes)); //
            var edges = new vis.DataSet(@json($edges));
            console.log(nodes);

            var container = document.getElementById('familyTree');

            var data = {
                nodes: nodes,
                edges: edges
            };

            var options = {
                configure: {
                    enabled: true,
                    filter: 'nodes,edges',
                    container: familyTree,
                    showButton: true
                },
                nodes: {
                    borderWidth: 1,
                    borderWidthSelected: 2,
                    brokenImage: undefined,
                    chosen: true,
                    color: {
                        border: '#2B7CE9',
                        background: '#97C2FC',
                        highlight: {
                            border: '#2B7CE9',
                            background: '#D2E5FF'
                        },
                        hover: {
                            border: '#2B7CE9',
                            background: '#D2E5FF'
                        }
                    },
                    opacity: 1,
                    fixed: {
                        x: false,
                        y: false
                    },
                    font: {
                        color: '#343434',
                        size: 14, // px
                        face: 'arial',
                        background: 'none',
                        strokeWidth: 0, // px
                        strokeColor: '#ffffff',
                        align: 'center',
                        multi: false,
                        vadjust: 0,
                        bold: {
                            color: '#343434',
                            size: 14, // px
                            face: 'arial',
                            vadjust: 0,
                            mod: 'bold'
                        },
                        ital: {
                            color: '#343434',
                            size: 14, // px
                            face: 'arial',
                            vadjust: 0,
                            mod: 'italic',
                        },
                        boldital: {
                            color: '#343434',
                            size: 14, // px
                            face: 'arial',
                            vadjust: 0,
                            mod: 'bold italic'
                        },
                        mono: {
                            color: '#343434',
                            size: 15, // px
                            face: 'courier new',
                            vadjust: 2,
                            mod: ''
                        }
                    },
                    group: undefined,
                    heightConstraint: false,
                    hidden: false,
                    // icon: {
                    //     face: 'FontAwesome',
                    // code: undefined,
                    //   weight: undefined,
                    // size: 50, //50,
                    // color: '#2B7CE9'
                    //},
                    //image: undefined,
                    //imagePadding: {
                    //  left: 2,
                    //top: 2,
                    //bottom: 2,
                    //right: 2
                    //},
                    label: undefined,
                    labelHighlightBold: true,
                    level: undefined,
                    mass: 1,
                    physics: true,
                    scaling: {
                        min: 10,
                        max: 30,
                        label: {
                            enabled: false,
                            min: 14,
                            max: 30,
                            maxVisible: 30,
                            drawThreshold: 5
                        },
                        customScalingFunction: function(min, max, total, value) {
                            if (max === min) {
                                return 0.5;
                            } else {
                                let scale = 1 / (max - min);
                                return Math.max(0, (value - min) * scale);
                            }
                        }
                    },
                    shadow: {
                        enabled: false,
                        color: 'rgba(0,0,0,0.5)',
                        size: 10,
                        x: 5,
                        y: 5
                    },
                    shape: 'circularImage',
                    shapeProperties: {
                        borderDashes: true, // only for borders
                        borderRadius: 6, // only for box shape
                        interpolation: false, // only for image and circularImage shapes
                        useImageSize: false, // only for image and circularImage shapes
                        useBorderWithImage: false, // only for image shape
                        coordinateOrigin: 'center' // only for image and circularImage shapes
                    },
                    size: 40,
                    title: undefined,
                    value: undefined,
                    widthConstraint: false,
                    x: 50,
                    y: 50
                },
                layout: {
                    randomSeed: undefined,
                    improvedLayout: true,
                    clusterThreshold: 150,
                    hierarchical: {
                        enabled: false,
                        levelSeparation: 150,
                        nodeSpacing: 100,
                        treeSpacing: 200,
                        blockShifting: true,
                        edgeMinimization: true,
                        parentCentralization: true,
                        direction: 'UD', // UD, DU, LR, RL
                        sortMethod: 'hubsize', // hubsize, directed
                        shakeTowards: 'leaves' // roots, leaves
                    }
                },
                physics: {
                    enabled: true,
                    solver: 'forceAtlas2Based',
                    hierarchicalRepulsion: {
                        nodeDistance: 200, // Adjust as desired
                        centralGravity: 0.2, // Adjust as desired
                    }
                },
                edges: {
                    arrows: {
                        to: {
                            enabled: false,
                            imageHeight: 32,
                            imageWidth: 32,
                            scaleFactor: 1,
                            // src: undefined,
                            type: "arrow"
                        },
                        middle: {
                            enabled: false,
                            imageHeight: 32,
                            imageWidth: 32,
                            scaleFactor: 1,
                            // src: "https://visjs.org/images/visjs_logo.png",
                            type: "image"
                        },
                        from: {
                            enabled: false,
                            imageHeight: 32,
                            imageWidth: 32,
                            scaleFactor: 1,
                            // src: undefined,
                            type: "arrow"
                        }
                    },
                    endPointOffset: {
                        from: 0,
                        to: 0
                    },
                    arrowStrikethrough: true,
                    chosen: true,
                    color: {
                        color: '#848484',
                        highlight: '#848484',
                        hover: '#848484',
                        inherit: 'from',
                        opacity: 1.0
                    },
                    dashes: true,
                    font: {
                        color: '#343434',
                        size: 10, // px
                        face: 'arial',
                        background: 'none',
                        strokeWidth: 2, // px
                        strokeColor: '#ffffff',
                        align: 'horizontal',
                        multi: false,
                        vadjust: 0,
                        bold: {
                            color: '#343434',
                            size: 14, // px
                            face: 'arial',
                            vadjust: 0,
                            mod: 'bold'
                        },
                        ital: {
                            color: '#343434',
                            size: 14, // px
                            face: 'arial',
                            vadjust: 0,
                            mod: 'italic',
                        },
                        boldital: {
                            color: '#343434',
                            size: 14, // px
                            face: 'arial',
                            vadjust: 0,
                            mod: 'bold italic'
                        },
                        mono: {
                            color: '#343434',
                            size: 15, // px
                            face: 'courier new',
                            vadjust: 2,
                            mod: ''
                        }
                    },
                    hidden: false,
                    hoverWidth: 1.5,
                    label: undefined,
                    labelHighlightBold: true,
                    length: undefined,
                    physics: true,
                    scaling: {
                        min: 1,
                        max: 15,
                        label: {
                            enabled: true,
                            min: 14,
                            max: 30,
                            maxVisible: 30,
                            drawThreshold: 5
                        },
                        customScalingFunction: function(min, max, total, value) {
                            if (max === min) {
                                return 0.5;
                            } else {
                                var scale = 1 / (max - min);
                                return Math.max(0, (value - min) * scale);
                            }
                        }
                    },
                    selectionWidth: 1,
                    // selfReferenceSize: 20,
                    selfReference: {
                        size: 20,
                        angle: Math.PI / 4,
                        renderBehindTheNode: true
                    },
                    shadow: {
                        enabled: false,
                        color: 'rgba(0,0,0,0.5)',
                        size: 10,
                        x: 5,
                        y: 5
                    },
                    smooth: {
                        enabled: true,
                        type: "dynamic",
                        roundness: 0.5
                    },
                    title: undefined,
                    value: undefined,
                    width: 1,
                    widthConstraint: false
                }
            };

            var network = new vis.Network(container, data, options);
            var contextMenu = document.getElementById('contextMenu');
            network.on('stabilized', function() {
                console.log('Layout Stabilized!')
            });
            network.on('click', function(params) {
                console.log('Node clicked:', params);
                if (params.nodes.length > 0) {
                    var nodeId = params.nodes[0];
                    var nodeLabel = nodes.get(nodeId).label; // Get node label
                    console.log('clickedNodeId:', nodeId)
                    contextMenu.style.display = 'block';
                    contextMenu.textContent = nodeLabel;
                    contextMenu.style.left = params.pointer.DOM.x + 'px';
                    contextMenu.style.top = params.pointer.DOM.y + 'px';
                    console.log("Menu position:", contextMenu.style.left, contextMenu.style.top);
                    console.log("Menu display:", contextMenu.style.display);
                } else {
                    contextMenu.style.display = 'none'; // Hide if not a node click
                }
            });

            // Handle context menu clicks
            contextMenu.addEventListener('click', function(event) {
                switch (event.target.id) {
                    case 'addProfilePhoto':
                        // Code to handle adding a profile photo
                        break;
                    case 'addFamilyMember':
                        // Code to handle adding a family member
                        break;
                    case 'editProfile':
                        // Code to handle editing the profile
                        break;
                }
                contextMenu.style.display = 'none'; // Hide the menu after action
            });

            // Hide the context menu when clicking outside of it
            document.addEventListener('click', function(event) {
                if (!contextMenu.contains(event.target)) {
                    contextMenu.style.display = 'none';
                }
            });
        </script>
    </x-app-layout>
</section>
