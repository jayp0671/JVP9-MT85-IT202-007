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

// Fetch the recipe details
$query = "SELECT * FROM Recipes WHERE id = $recipeId";
$result = $conn->query($query);

// Check if the recipe with the given ID exists
if ($result->num_rows === 0) {
    flash("Recipe not found", "danger");
    header("Location: list_recipes.php");
    exit;
}

// Fetch the recipe details
$recipe = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Recipe Details</title>
    <style>
        /* Your custom styles here */
    </style>
</head>
<body>

<h1>Recipe Details</h1>

<!-- Display detailed information about the recipe -->
<p><strong>Title:</strong> <?php echo $recipe['title']; ?></p>
<p><strong>Ingredients:</strong>
    <ul>
        <?php
        // Explode the ingredients string into an array and display each ingredient
        $ingredients = explode("|", $recipe['ingredients']);
        foreach ($ingredients as $ingredient) {
            echo "<li>$ingredient</li>";
        }
        ?>
    </ul>
</p>
<p><strong>Instructions:</strong> <?php echo $recipe['instructions']; ?></p>
<p><strong>Servings:</strong> <?php echo $recipe['servings']; ?></p>
<p><strong>Source:</strong> <?php echo $recipe['source']; ?></p>

<!-- Links for actions -->
<div>
    <!-- No role check here, allowing everyone to see the edit and delete links -->
    <a href='edit_recipe.php?id=<?php echo $recipeId; ?>'>Edit Recipe</a>
    <a href='delete_recipe.php?id=<?php echo $recipeId; ?>'>Delete Recipe</a>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
