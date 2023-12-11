<style>
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

// Handle filtering and sorting
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10; // Default to 10 if not provided
$sortField = isset($_GET['sort']) ? $_GET['sort'] : 'title'; // Default sorting field
$sortOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC'; // Default sorting order

// Query to retrieve data not associated with any user
$query = "SELECT * FROM Recipes WHERE user_id IS NULL ORDER BY $sortField $sortOrder LIMIT $limit";
$result = $conn->query($query);

// Query to count the number of recipes with NULL user_id
$countQuery = "SELECT COUNT(*) AS totalItems FROM Recipes WHERE user_id IS NULL";
$countResult = $conn->query($countQuery);
$countRow = $countResult->fetch_assoc();
$totalItems = $countRow['totalItems'];

// Check if there are rows in the result
if ($result->num_rows > 0) {
    // Display the filter and sort form
    echo "<form method='get'>";
    echo "Filter by Limit: <input type='number' name='limit' min='1' max='100' value='$limit'>";
    echo " Sort by: 
          <select name='sort'>
            <option value='title'>Title</option>
            <option value='servings'>Servings</option>
          </select>";
    echo " Order: 
          <select name='order'>
            <option value='ASC'>Ascending</option>
            <option value='DESC'>Descending</option>
          </select>";
    echo "<button type='submit'>Apply</button>";
    echo "</form>";

    // Display the total number of items
    echo "<h1>Data List</h1>";
    echo "<p>Total Items Not Associated with Anyone: $totalItems</p>";
    echo "<p>Total Items Shown on the Page: " . $result->num_rows . "</p>";


    echo "<table>";
    echo "<tr><th>Title</th><th>Ingredients</th><th>Instructions</th><th>Servings</th><th>Source</th><th>Actions</th></tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["ingredients"] . "</td>";
        echo "<td>" . $row["instructions"] . "</td>";
        echo "<td>" . $row["servings"] . "</td>";
        echo "<td>" . $row["source"] . "</td>";

        // Add links for actions
        echo "<td class='action-links'>";
        echo "<a href='view_recipe_na.php?id=" . $row["id"] . "'>View</a>";
        // echo "<a href='delete_recipe_all.php?id=" . $row["id"] . "'>Delete</a>";

        echo "</td>";

        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No results available.";
}

// Close the database connection
$conn->close();
?>

</body>
</html>