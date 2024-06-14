<?php
session_start();
include('db_config.php');

// Check if the user is logged in and if they are an admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: login.html");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tool Inventory Management</title>
  <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"], input[type="number"] {
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            background-color: #f9f9f9;
        }

        button {
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #007bff;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-button {
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            background-color: #ff4b4b;
            color: white;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .action-button.add {
            background-color: #28a745;
        }

        .action-button.subtract {
            background-color: #dc3545;
        }

        .action-button:hover.add {
            background-color: #218838;
        }

        .action-button:hover.subtract {
            background-color: #c82333;
        }

        .order-button {
            display: block;
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 8px;
            background-color: #ff4b4b;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-align: center;
        }

        .order-button:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tool Inventory Management</h2>
    <form action="add_tool.php" method="post">
        <label for="toolName">Tool Name:</label>
        <input type="text" id="toolName" name="toolName" required>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>

        <button type="submit">Add Tool</button>
    </form>

    <h3>Current Inventory</h3>
    <table>
        <tr>
            <th>Tool Name</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        <!-- Dynamically populate this table with inventory data -->
        <?php
        $query = "SELECT * FROM inventory";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['tool_name'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>
                    <div class='action-buttons'>
                        <button class='action-button add'>Add</button>
                        <button class='action-button subtract'>Subtract</button>
                    </div>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <button class="order-button">Order New Tools</button>
</div>

</body>
</html>
