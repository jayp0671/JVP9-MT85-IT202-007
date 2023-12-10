<?php
require_once(__DIR__ . "/../../partials/nav.php");
require(__DIR__ . "/../../partials/flash.php");
$host = "db.ethereallab.app";
$username = "jvp9";
$password = "dgkRX0qbRPKs";
$database = "jvp9";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch recipes added by the logged-in user
$userId = $_SESSION['user']['id'];

$sql = "SELECT * FROM Recipes WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites</title>
    <style>
        /* Add your provided CSS styles here */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            border: 0px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            background-color: #f9f9f9; /* Set background color for all rows to white */
        }

        th {
            background-color: #f2f2f2;
        }

        .action-links {
            white-space: nowrap; /* Prevent line breaks for inline elements */
        }

        .action-links a {
            margin-right: 10px; /* Add space between action links */
        }
    </style>
</head>

<body>
    <h1>Favorites</h1>

    <?php
    // Display recipes in a table
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Title</th><th>Ingredients</th><th>Servings</th><th>Instructions</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['ingredients']}</td>";
            echo "<td>{$row['servings']}</td>";
            echo "<td>{$row['instructions']}</td>";

            // You can add more details or actions here

            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No favorites found.";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
    ?>
</body>

</html>
