<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Tool Request Form</title>
  <style>
    /* Styles for the employee tool request form */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .container {
      max-width: 600px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2, h3 {
      text-align: center;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-top: 10px;
    }

    input[type="text"], input[type="number"] {
      padding: 10px;
      margin-top: 5px;
    }

    button {
      padding: 10px;
      margin-top: 20px;
      background-color: #28a745;
      color: #fff;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background-color: #218838;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 10px;
      text-align: left;
      border: 1px solid #ddd;
    }

    .order-button {
      margin-top: 20px;
      background-color: #007bff;
    }

    .order-button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<div class="container">
    <h2>Employee Tool Request Form</h2>
    <form id="requestForm">
        <label for="toolName">Tool Name:</label>
        <input type="text" id="toolName" name="toolName" required>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>

        <button type="submit">Request Tool</button>
    </form>

    <h3>Current Inventory</h3>
    <table id="inventoryTable">
        <!-- Table for displaying current inventory -->
        <thead>
            <tr>
                <th>Tool Name</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <!-- Inventory items will be inserted here by JavaScript -->
        </tbody>
    </table>

    <button class="order-button">Order New Tools</button>
</div>

<script>
    // JavaScript code for handling tool requests and inventory management
    document.addEventListener('DOMContentLoaded', function() {
        const requestForm = document.getElementById('requestForm');
        const inventoryTableBody = document.getElementById('inventoryTable').querySelector('tbody');

        // Mock inventory data
        const inventory = [
            { toolName: 'Hammer', quantity: 10 },
            { toolName: 'Screwdriver', quantity: 15 },
            { toolName: 'Wrench', quantity: 5 }
        ];

        // Function to render inventory table
        function renderInventory() {
            inventoryTableBody.innerHTML = '';
            inventory.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${item.toolName}</td><td>${item.quantity}</td>`;
                inventoryTableBody.appendChild(row);
            });
        }

        // Initial render of inventory
        renderInventory();

        // Handle form submission
        requestForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const toolName = document.getElementById('toolName').value;
            const quantity = parseInt(document.getElementById('quantity').value);

            // Update inventory
            const tool = inventory.find(item => item.toolName.toLowerCase() === toolName.toLowerCase());
            if (tool) {
                tool.quantity += quantity;
            } else {
                inventory.push({ toolName, quantity });
            }

            // Re-render inventory
            renderInventory();

            // Reset form
            requestForm.reset();
        });

        // Handle ordering new tools
        document.querySelector('.order-button').addEventListener('click', function() {
            alert('Ordering new tools functionality is not implemented yet.');
        });
    });
</script>

</body>
</html>
