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

// Ensure the ID parameter is set
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    flash("Invalid user ID", "danger");
    header("Location: list_users.php");
    exit;
}

$userId = intval($_GET['id']);

// Fetch user details from the database based on the ID
$query = "SELECT * FROM Users WHERE id = $userId";
$result = $conn->query($query);

// Check if the user with the given ID exists
if ($result->num_rows === 0) {
    flash("User not found", "danger");
    header("Location: list_users.php");
    exit;
}

// Fetch the user details
$user = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        /* Your custom styles here */
    </style>
</head>
<body>

<h1>User Profile</h1>

<!-- Display detailed information about the user -->
<p><strong>Username:</strong> <?php echo $user['username']; ?></p>
<p><strong>Date Joined:</strong> <?php echo $user['created']; ?></p>
<!-- Add more fields as needed -->

<!-- Links for actions -->
<div>
    <!-- You can add links or actions related to the user profile here -->
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
