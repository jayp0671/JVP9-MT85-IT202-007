<?php
require_once(__DIR__ . "/../../partials/nav.php");
require(__DIR__ . "/../../partials/flash.php");

// Ensure the ID parameter is set
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    flash("Invalid recipe ID", "danger");
    header("Location: my_recipes.php");
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

// Check for necessary roles/permissions to delete (add your logic here)

// Update the user_id to null for the specified recipe ID
$updateQuery = "UPDATE Recipes SET user_id=NULL WHERE id=?";
$stmt = $conn->prepare($updateQuery);

if ($stmt) {
    $stmt->bind_param("i", $recipeId);
    $stmt->execute();
    $stmt->close();

    flash("Association removed successfully", "success");

    // Redirect to the previous page with the same filter/sort
    $redirectUrl = "all_users_association.php"; // Update with your actual list page
    header("Location: $redirectUrl");
    exit;
} else {
    flash("Error removing association", "danger");
    header("Location: all_users_association.php");
    exit;
}
?>
