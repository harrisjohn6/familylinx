mounted();
{
    let diagram = new go.Diagram("familyTreeDiagram");

    axios
        .get("/go-family-tree")
        .then((response) => {
            // Populate GoJS Diagram Model
            diagram.model = new go.GraphLinksModel(
                familyData.nodeDataArray,
                familyData.linkDataArray
            );

            // Basic Node Template (Modified bindings slightly)
            diagram.nodeTemplate = new go.Node("Auto")
                .add(
                    new go.Shape("Circle", {
                        fill: "lightblue",
                    })
                )
                .add(
                    new go.Picture(
                        {
                            source: new go.Binding("image"),
                        }, // Assumes 'image' property in node data
                        new go.Binding("width"), // Use defaults for size
                        new go.Binding("height")
                    )
                )
                .add(
                    new go.TextBlock(
                        {
                            text: new go.Binding("label"),
                        },
                        new go.Binding("margin", "", () => 5)
                    )
                );

            // ... Link Template (Unchanged) ...
        })
        .catch((error) => {
            console.error("Error fetching data:", error);
        });
}
