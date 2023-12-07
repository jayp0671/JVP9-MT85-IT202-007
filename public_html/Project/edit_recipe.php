<?php
require(__DIR__ . "/../../partials/nav.php");
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

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $title = $_POST["title"];
    $ingredients = $_POST["ingredients"];
    $instructions = $_POST["instructions"];
    $servings = $_POST["servings"];

    // Validate form data (add your validation logic here)

    // Update the database with the new data
    $updateQuery = "UPDATE Recipes SET title=?, ingredients=?, instructions=?, servings=? WHERE id=?";
    $stmt = $conn->prepare($updateQuery);

    if ($stmt) {
        $stmt->bind_param("ssssi", $title, $ingredients, $instructions, $servings, $recipeId);
        $stmt->execute();
        $stmt->close();

        flash("Recipe updated successfully", "success");
    } else {
        flash("Error updating recipe", "danger");
    }

    // Redirect to the view details page after update
    header("Location: view_recipe.php?id=$recipeId");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe</title>
    <style>
        /* Your custom styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #87CEEB; /* Set a background color */
        }

        nav {
            background-color: #87CEEB;/* Your navigation bar background color */;
        }

        .container {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #336699;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-right: 0px;
            width: 100%;
            flex-shrink: 0;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <?php require_once(__DIR__ . "/../../partials/nav.php"); ?>

    <div class="container">

        <h1>Edit Recipe</h1>

        <!-- Display the form with pre-filled values -->
        <form method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($recipe['title']); ?>" required>

            <label for="ingredients">Ingredients:</label>
            <textarea id="ingredients" name="ingredients" rows="4" required><?php echo htmlspecialchars($recipe['ingredients']); ?></textarea>

            <label for="instructions">Instructions:</label>
            <textarea id="instructions" name="instructions" rows="4" required><?php echo htmlspecialchars($recipe['instructions']); ?></textarea>

            <label for="servings">Servings:</label>
            <input type="number" id="servings" name="servings" value="<?php echo htmlspecialchars($recipe['servings']); ?>" required>

            <button type="submit">Update Recipe</button>
        </form>

    </div>

</body>

</html>

<?php
// Close the database connection
$conn->close();
?>
