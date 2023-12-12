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

$sqlCount = "SELECT COUNT(*) as total FROM Recipes WHERE user_id = ?";
$stmtCount = $conn->prepare($sqlCount);
$stmtCount->bind_param("i", $userId);
$stmtCount->execute();
$resultCount = $stmtCount->get_result();

// Get the total count of items associated with the user
$totalItemCount = $resultCount->fetch_assoc()['total'];

// Handle filtering and sorting
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10; // Default to 10 if not provided
$sortField = isset($_GET['sort']) ? $_GET['sort'] : 'title'; // Default sorting field
$sortOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC'; // Default sorting order

// Query to retrieve data from your table with filtering and sorting
$query = "SELECT * FROM Recipes WHERE user_id = $userId ORDER BY $sortField $sortOrder LIMIT $limit";
$result = $conn->query($query);

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

    <!-- Display total count of items associated with the user -->
    <p>Total items associated with you: <?php echo $totalItemCount; ?></p>

    <!-- Display the total number of items shown on the page -->
    <p>Total items shown on this page: <?php echo $result->num_rows; ?></p>

    <!-- Filter and sort form -->
    <form method='get'>
        <label for="limit">Limit:</label>
        <input type='number' name='limit' min='1' max='100' value='<?php echo $limit; ?>'>
        <label for="sort">Sort by:</label>
        <select name='sort'>
            <option value='title' <?php echo $sortField === 'title' ? 'selected' : ''; ?>>Title</option>
            <option value='servings' <?php echo $sortField === 'servings' ? 'selected' : ''; ?>>Servings</option>
        </select>
        <label for="order">Order:</label>
        <select name='order'>
            <option value='ASC' <?php echo $sortOrder === 'ASC' ? 'selected' : ''; ?>>Ascending</option>
            <option value='DESC' <?php echo $sortOrder === 'DESC' ? 'selected' : ''; ?>>Descending</option>
        </select>
        <button type='submit'>Apply</button>
    </form>

    <?php
    // Display recipes in a table
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Title</th><th>Ingredients</th><th>Servings</th><th>Instructions</th><th>Actions</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['ingredients']}</td>";
            echo "<td>{$row['servings']}</td>";
            echo "<td>{$row['instructions']}</td>";

            // Add links for single view and delete actions
            echo "<td class='action-links'>";
            echo "<a href='view_recipe_user.php?id=" . $row["id"] . "'>View</a>";
            echo "<a href='delete_recipe_user.php?id=" . $row["id"] . "'>Delete</a>";
            echo "</td>";

            echo "</tr>";
        }

        echo "</table>";

        // Link/button to remove all associations for the logged-in user
        echo "<a href='remove_all_associations.php'>Remove All Associations</a>";
    } else {
        echo "No results available.";
    }

    // Close the database connection
    $stmtCount->close();
    $conn->close();
    ?>
</body>

</html>
