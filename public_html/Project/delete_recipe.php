<?php
require_once(__DIR__ . "/../../partials/nav.php");
require(__DIR__ . "/../../partials/flash.php");

// Ensure the ID parameter is set
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    flash("Invalid recipe ID", "danger");
    header("Location: list_recipes.php");
    exit;
}

$recipeId = intval($_GET['id']);

// Fetch recipe details from the database based on the ID
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

// Fetch the existing recipe details
$query = "SELECT * FROM Recipes WHERE id = $recipeId";
$result = $conn->query($query);

// Check if the recipe with the given ID exists
if ($result->num_rows === 0) {
    flash("Recipe not found", "danger");
    header("Location: list_recipes.php");
    exit;
}

// Fetch the existing recipe details
$recipe = $result->fetch_assoc();

// Check for necessary roles/permissions to delete (add your logic here)

// Perform deletion (consider soft or hard delete based on your requirements)
$deleteQuery = "DELETE FROM Recipes WHERE id=?";
$stmt = $conn->prepare($deleteQuery);

if ($stmt) {
    $stmt->bind_param("i", $recipeId);
    $stmt->execute();
    $stmt->close();

    flash("Recipe deleted successfully", "success");

    // Redirect to the previous page with the same filter/sort
    $redirectUrl = "my_recipes.php"; // Update with your actual list page
    header("Location: $redirectUrl");
    exit;
} else {
    flash("Error deleting recipe", "danger");
    header("Location: list_recipes.php");
    exit;
}
?>
