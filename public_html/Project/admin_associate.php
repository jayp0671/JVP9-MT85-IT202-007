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

// Handle Form Submission and Display Results
$resultsEntities = [];
$resultsUsers = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';

    // Query to retrieve partially matched entities and users
    $queryEntities = "SELECT Recipes.*, Users.username AS associated_user 
                      FROM Recipes 
                      LEFT JOIN Users ON Recipes.user_id = Users.id 
                      WHERE title LIKE CONCAT('%', ?, '%') AND Recipes.user_id IS NOT NULL
                      LIMIT 25";
    $stmtEntities = $conn->prepare($queryEntities);
    $stmtEntities->bind_param("s", $title);
    $stmtEntities->execute();
    $resultEntities = $stmtEntities->get_result();

    while ($rowEntity = $resultEntities->fetch_assoc()) {
        $resultsEntities[] = $rowEntity;
    }

    $stmtEntities->close();

    // Query to retrieve partially matched users
    $queryUsers = "SELECT * FROM Users WHERE username LIKE CONCAT('%', ?, '%') LIMIT 25";
    $stmtUsers = $conn->prepare($queryUsers);
    $stmtUsers->bind_param("s", $username);
    $stmtUsers->execute();
    $resultUsers = $stmtUsers->get_result();

    while ($rowUser = $resultUsers->fetch_assoc()) {
        $resultsUsers[] = $rowUser;
    }

    $stmtUsers->close();

    // Logic to apply associations based on selected entities and users
    if (isset($_POST['selected_entity']) && isset($_POST['selected_user'])) {
        $selectedEntity = $_POST['selected_entity'];
        $selectedUser = $_POST['selected_user'];

        // Associate the selected entity with the selected user
        associateEntityWithUser($selectedEntity, $selectedUser);

        header("Location: all_users_association.php");
    exit();
    }
}

// Function to associate entities with users (replace with your actual database logic)
function associateEntityWithUser($entity, $user) {
    global $conn;

    // Check if the association already exists
    $checkQuery = "SELECT * FROM Recipes WHERE title = ? AND user_id = (SELECT id FROM Users WHERE username = ?)";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("ss", $entity, $user);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // Association exists, remove it
        $removeQuery = "UPDATE Recipes SET user_id = NULL WHERE title = ? AND user_id = (SELECT id FROM Users WHERE username = ?)";
        $removeStmt = $conn->prepare($removeQuery);
        $removeStmt->bind_param("ss", $entity, $user);
        $removeStmt->execute();
    } else {
        // Association doesn't exist, add it
        $addQuery = "UPDATE Recipes SET user_id = (SELECT id FROM Users WHERE username = ?) WHERE title = ?";
        $addStmt = $conn->prepare($addQuery);
        $addStmt->bind_param("ss", $user, $entity);
        $addStmt->execute();
    }

    $checkStmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Associate Page</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>

<h1>Admin Associate Page</h1>

<form method="post" action="admin_associate.php">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required>

    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>

    <button type="submit">Search</button>
</form>

<?php if (!empty($resultsEntities) || !empty($resultsUsers)): ?>
    <!-- Display the results -->
    <form method="post" action="admin_associate.php">
        <h2>Partially Matched Entities:</h2>
        <div>
            <?php foreach ($resultsEntities as $rowEntity): ?>
                <label>
                    <input type="radio" name="selected_entity" value="<?php echo $rowEntity['title']; ?>">
                    <?php echo $rowEntity['title']; ?> (Associated User: <?php echo $rowEntity['associated_user']; ?>)
                </label>
            <?php endforeach; ?>
        </div>

        <h2>Partially Matched Users:</h2>
        <div>
            <?php foreach ($resultsUsers as $rowUser): ?>
                <label>
                    <input type="radio" name="selected_user" value="<?php echo $rowUser['username']; ?>">
                    <?php echo $rowUser['username']; ?>
                </label>
            <?php endforeach; ?>
        </div>

        <button type="submit">Apply Associations</button>
    </form>
<?php endif; ?>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
