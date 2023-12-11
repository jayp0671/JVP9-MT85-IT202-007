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

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['username'])) {
    $username = $_GET['username'];

    // Remove all associations for the specified user
    $query = "UPDATE Recipes SET user_id = NULL WHERE user_id = (SELECT id FROM Users WHERE username = ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    // Check if any associations were removed
    if ($stmt->affected_rows > 0) {
        flash("All associations for user $username have been removed.", "success");
    } else {
        flash("No associations found for user $username.", "info");
    }

    $stmt->close();
}

// Close the database connection
$conn->close();

// Redirect to the original page
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>
