<?php
require_once(__DIR__ . "/../../partials/nav.php");
require(__DIR__ . "/../../partials/flash.php");

// Ensure the user is logged in
if (!isset($_SESSION['user'])) {
    flash("You must be logged in to perform this action", "danger");
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user']['id'];

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

// Remove associations
$sql = "UPDATE Recipes SET user_id = NULL WHERE user_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->close();

    flash("All associations removed successfully", "success");
} else {
    flash("Error removing associations", "danger");
}

// Close the database connection
$conn->close();

// Redirect to favorites page
header("Location: favorites.php");
exit;
?>
