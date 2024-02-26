let calendarContainer = document.getElementById("calendar-container");
if (calendarContainer) {
    let diagram = new go.Diagram("calendar-container");
    diagram.nodeTemplate = new go.Node("Vertical", {
        background: "lightgray",
    }).add(
        new go.Panel("Auto")
            .add(
                new go.TextBlock("Day 1", {
                    // Replace with day number
                    margin: 5,
                    text: new go.Binding("key", "", (key) => "Day " + key),
                })
            )
            .add(
                new go.Panel(
                    "Auto", // Container for birthday listings
                    new go.TextBlock("Birthdays:", {
                        font: "bold 10pt sans-serif",
                    }),
                    new go.Shape("Circle", {
                        fill: "red",
                        width: 5,
                        height: 5,
                        visible: false,
                    }).bind(
                        "visible",
                        "birthdayData",
                        (data) => data && data.length > 0
                    ),
                    new go.Panel("Vertical", {
                        itemTemplate: new go.Panel(
                            "Auto",
                            new go.TextBlock(
                                {
                                    margin: 2,
                                    stroke: "gray",
                                },
                                new go.Binding("text", "", (bday) => bday.Name)
                            )
                        ),
                    }).bind("itemArray", "birthdayData")
                )
            )
    );
    // Function to Build the Calendar Grid
    function buildCalendar(birthdaysByDay) {
        const month = 2; // Example: November
        const year = 2024;
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        diagram.model = new go.GraphLinksModel();
        diagram.model.nodeDataArray = [];
        console.log("nodeDataArray: ", diagram.model.nodeDataArray);
        for (let i = 1; i <= daysInMonth; i++) {
            const dateKey = ("0" + month).slice(-2) + "-" + ("0" + i).slice(-2); // MM-DD format
            diagram.model.addNodeData({
                key: i, // Key to identify 'day' node
                birthdayData: birthdaysByDay[dateKey] || [],
            });
        }
        diagram.layout = new go.GridLayout(); // Add this for automatic layout of days as a grid
    }
    fetch("/sanctum/csrf-cookie").then(() => {
        fetch("/birthdays", {
            method: "GET",
            headers: {
                "X-XSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
        })
            .then((response) => {
                if (!response.ok) {
                    throw Error(response.statusText);
                }
                return response.json(); // Return the promise for chaining
            })
            .then((birthdayData) => {
                // Use 'birthdayData' here for clarity
                const birthdaysByDay = {};
                birthdayData.forEach((birthday) => {
                    const date = birthday.dateBirth.substring(5);
                    if (!birthdaysByDay[date]) {
                        birthdaysByDay[date] = [];
                    }
                    birthdaysByDay[date].push(birthday);
                    console.log("birthday: ", birthday);
                });
                console.log("birthdaysByDay: ", birthdaysByDay);
                buildCalendar(birthdaysByDay);
            })
            .catch((error) => {
                console.error("Error fetching birthdays:", error);
            });
    });
}