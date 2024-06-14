document.addEventListener("DOMContentLoaded", function() {
    async function fetchRequestedTools() {
        // Simulate fetching data from a server
        const response = await fetch('requested-tools.json');
        const requestedTools = await response.json();

        const tableBody = document.querySelector("#toolsTable tbody");

        requestedTools.forEach(tool => {
            const row = document.createElement("tr");

            row.innerHTML = `
                <td>${tool.id}</td>
                <td>${tool.name}</td>
                <td>${tool.quantity}</td>
                <td>${tool.requestedBy}</td>
                <td>${tool.date}</td>
            `;

            tableBody.appendChild(row);
        });
    }

    fetchRequestedTools().catch(error => {
        console.error("Error fetching data: ", error);
    });
});
